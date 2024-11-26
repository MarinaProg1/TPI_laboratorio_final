<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    
        public function index()
{
    // Obtener el carrito activo del usuario
    $cart = Cart::where('user_id', auth()->id())
                ->where('state', 'active')
                ->first();

    // Si el carrito existe, obtener los productos relacionados
    if ($cart) {
        // Obtener los productos con las cantidades
        $products = $cart->products;
    } else {
        $products = collect(); // Si no hay carrito, devolver una colección vacía
    }

    return view('carts.index', compact('cart', 'products')); // Pasar el carrito y los productos a la vista
  }

 
  public function add(Request $request, $productId)
{
    // Obtener el producto
    $product = Product::findOrFail($productId);

    // Obtener o crear el carrito para el usuario
    $cart = Cart::firstOrCreate([
        'user_id' => Auth::id(),
        'state' => 'active',
    ]);

    // Verificar si el producto ya está en el carrito
    $existingProduct = $cart->products()->where('products.id', $product->id)->first();

    // Calcular la cantidad total en el carrito
    $currentQuantity = $existingProduct ? $existingProduct->pivot->quantity : 0;

    // Validar el stock
    if ($currentQuantity + 1 > $product->stock) {
        return redirect()->route('carts.index')->with('error', 'No hay suficiente stock disponible para este producto.');
    }

    if ($existingProduct) {
        // Si ya existe, aumentar la cantidad en 1
        $cart->products()->updateExistingPivot($product->id, [
            'quantity' => $currentQuantity + 1,
        ]);
    } else {
        // Si no existe, agregarlo con una cantidad inicial de 1
        $cart->products()->attach($product->id, ['quantity' => 1]);
    }

    // Redirigir al carrito
    return redirect()->route('carts.index')->with('success', 'Producto agregado al carrito.');
}


   

    public function update(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1',
        ]);

        $cart = Cart::where('user_id', Auth::id())->where('state', 'active')->first();

        if ($cart) {
            if ($cart->products()->where('products.id', $productId)->exists()) {
                  $cart->products()->updateExistingPivot($productId, [
                    'quantity' => $request->quantity,
                ]);
            } else {
                return redirect()->route('carts.index')->with('error', 'El producto no está en el carrito.');
            }
        } else {
            return redirect()->route('carts.index')->with('error', 'No hay carrito activo.');
        }

        return redirect()->route('carts.index')->with('success', 'Cantidad actualizada.');
    }

    public function checkout()
    {
        $cart = Cart::where('user_id', Auth::id())
                    ->where('state', 'active')
                    ->with('products') 
                    ->first();
        if (!$cart) {
            return redirect()->route('carts.index')->with('error', 'No tienes un carrito activo.');
        }

            $total = $cart->products->sum(function ($product) {
            return $product->pivot->quantity * $product->price;
        });

        return view('carts.checkout', compact('cart', 'total'));
    }

    public function processCheckout(Request $request)
{
    $request->validate([
        'address' => 'required|string|max:255',
        'payment_method' => 'required|string',
    ]);
    $cart = Cart::where('user_id', Auth::id())
                ->where('state', 'active')
                ->first();

    if (!$cart) {
        return redirect()->route('carts.index')->with('error', 'No tienes un carrito activo.');
    }

   
    $cart->update([
        'state' => 'completed',
        'shipping_address' => $request->address,
        'payment_method' => $request->payment_method,
    ]);

    return redirect()->route('carts.index')->with('success', 'Compra realizada con éxito.');
}

}
