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
    $carts = Cart::where('user_id', Auth::id())
                ->where('state', 'active')
                ->with('products')
                ->get(); 

    return view('carts.index', compact('carts'));
}

public function add(Request $request, $productId)
{
    // Obtener el producto
    $product = Product::findOrFail($productId);

    // Obtener o crear el carrito para el usuario
    $carts = Cart::firstOrCreate([
        'user_id' => Auth::id(),
        'state' => 'active'
    ]);

    // Verificar si el producto ya está en el carrito
    if ($carts->products()->where('id', $product->id)->exists()) {
        // Si ya existe, podrías optar por aumentar la cantidad
        return redirect()->route('carts.index')->with('info', 'El producto ya está en el carrito.');
    }

    // Agregar el producto al carrito
    $carts->products()->attach($product->id, ['quantity' => 1]); // Puedes ajustar la cantidad inicial

    return redirect()->route('products.index')->with('success', 'Producto agregado al carrito.');
}

public function update(Request $request, $productId)
{
    // Validar la entrada
    $request->validate([
        'quantity' => 'required|numeric|min:1',
    ]);

    // Obtener el carrito activo del usuario
    $carts = Cart::where('user_id', Auth::id())->where('state', 'active')->first();

    if ($carts) {
        // Verificar si el producto ya está en el carrito
        if ($cart->products()->where('id', $productId)->exists()) {
            // Actualizar la cantidad del producto en el carrito
            $carts->products()->updateExistingPivot($productId, [
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
}
