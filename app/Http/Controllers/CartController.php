<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Mostrar el contenido del carrito
    public function index()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->firstOrCreate(['state' => 'open']);

        return view('cart.index', ['cart' => $cart, 'products' => $cart->products]);
    }

    // Agregar un producto al carrito
    public function add(Request $request, Product $product)
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->firstOrCreate(['state' => 'open']);
        
        if (!$cart->products->contains($product->id)) {
            $cart->products()->attach($product->id, ['quantity' => $request->input('quantity', 1)]);
        } else {
            // Si el producto ya está en el carrito, actualiza la cantidad
            $cart->products()->updateExistingPivot($product->id, [
                'quantity' => $cart->products()->find($product->id)->pivot->quantity + $request->input('quantity', 1)
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Producto agregado al carrito.');
    }

    // Actualizar la cantidad de un producto en el carrito
    public function update(Request $request, Product $product)
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->firstOrCreate(['state' => 'open']);
        
        if ($cart->products->contains($product->id)) {
            $cart->products()->updateExistingPivot($product->id, ['quantity' => $request->input('quantity')]);
        }

        return redirect()->route('cart.index')->with('success', 'Cantidad actualizada.');
    }

    // Eliminar un producto del carrito
    public function remove(Product $product)
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->firstOrCreate(['state' => 'open']);
        
        if ($cart->products->contains($product->id)) {
            $cart->products()->detach($product->id);
        }

        return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito.');
    }
}
