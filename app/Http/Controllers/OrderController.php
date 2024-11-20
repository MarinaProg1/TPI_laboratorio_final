<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'cart')->get();
        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('user', 'cart')->findOrFail($id);
        return view('orders.show', compact('order'));
    }
    
    public function create()
    {
        $carts = Cart::where('state', 'completed')->get(); 
        return view('orders.create', compact('carts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_date' => 'required|date',
            'state' => 'required|string',
            'cart_id' => 'required|exists:carts,id',
        ]);

        $order = Order::create([
            'order_date' => $request->order_date,
            'state' => $request->state,
            'cart_id' => $request->cart_id,
            'user_id' => auth()->id(), 
        ]);

        return redirect()->route('orders.index')->with('success', 'Orden creada con éxito.');
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $carts = Cart::where('state', 'completed')->get(); 
        return view('orders.edit', compact('order', 'carts'));
    }


    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'order_date' => 'required|date',
            'state' => 'required|string',
        ]);

        $order->update([
            'order_date' => $request->order_date,
            'state' => $request->state,
        ]);

        return redirect()->route('orders.index')->with('success', 'Orden actualizada con éxito.');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Orden eliminada con éxito.');
    }
}
