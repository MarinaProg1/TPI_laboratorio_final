<?php
namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Cart;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
   public function index()
{
    $invoices = Invoice::with('cart.user')->get();
    return view('invoices.index', compact('invoices'));
}


    public function show($id)
    {
        $invoices = Invoice::findOrFail($id);
        return view('invoices.show', compact('invoices'));
    }

    
   public function create()
{
    $cart = auth()->user()->carts()->latest()->first();

    if (!$cart || $cart->products->isEmpty()) {
        return redirect()->route('products.index')->with('error', 'Tu carrito está vacío.');
    }

    return view('invoices.create', compact('cart'));
}

public function store(Request $request)
{
    $request->validate([
        'payment_date' => 'required|date',
        'payment_method' => 'required|string',
        'state' => 'required|string',
    ]);

    $cart = auth()->user()->carts()->latest()->first();

    if (!$cart || $cart->products->isEmpty()) {
        return redirect()->route('products.index')->with('error', 'Tu carrito está vacío.');
    }

    $invoice = Invoice::create([
        'cart_id' => $cart->id,
        'payment_date' => $request->payment_date,
        'payment_method' => $request->payment_method,
        'state' => 'pendiente',
    ]);

    // Vaciar el carrito
    $cart->products()->detach();

    return redirect()->route('invoices.index')->with('success', 'Factura creada con éxito.');
}

    public function edit($id)
{
    $invoice = Invoice::findOrFail($id);
    return view('invoices.edit', compact('invoice'));
}


    public function update(Request $request, $id)
    {
        $request->validate([
            'state' => 'required|string',
        ]);

        $invoice = Invoice::findOrFail($id);
        $invoice->update([
            'state' => $request->input('state'),
        ]);

        return redirect()->route('invoices.index')->with('success', 'Estado de la factura actualizado con éxito.');
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return redirect()->route('invoices.index')->with('success', 'Factura eliminada con éxito.');
    }
}
