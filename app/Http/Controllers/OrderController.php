<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Mostrar todas las órdenes
    public function index()
    {
        $orders = Order::with(['user', 'cart'])->get();
        return view('orders.index', ['orders' => $orders]);
    }

    // Crear una nueva orden
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'order_date' => 'required|date',
            'state' => 'required|string',
            'cart_id' => 'required|exists:carts,id',
        ]);

        $order = new Order($validatedData);
        $order->user_id = Auth::id(); // Asocia la orden al usuario autenticado
        $order->save();

        // Asocia el carrito con la orden
        $cart = Cart::findOrFail($validatedData['cart_id']);
        $cart->order()->associate($order);
        $cart->save();

        return redirect()->route('orders.index')->with('success', 'Orden creada con éxito.');
    }

    // Mostrar los detalles de una orden específica
    public function show(Order $order)
    {
        return view('orders.show', ['order' => $order]);
    }

    // Actualizar una orden existente
    public function update(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'order_date' => 'required|date',
            'state' => 'required|string',
        ]);

        $order->update($validatedData);

        return redirect()->route('orders.show', $order)->with('success', 'Orden actualizada con éxito.');
    }

    // Eliminar una orden
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Orden eliminada con éxito.');
    }
}

