<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Cart;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    // Mostrar todas las facturas
    public function index()
    {
        $invoices = Invoice::with('cart')->get();
        return view('invoices.index', ['invoices' => $invoices]);
    }

    // Crear una nueva factura
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'payment_date' => 'required|date',
            'payment_method' => 'required|string',
            'state' => 'required|string',
        ]);

        $invoice = Invoice::create([
            'cart_id' => $validatedData['cart_id'],
            'payment_date' => $validatedData['payment_date'],
            'payment_method' => $validatedData['payment_method'],
            'state' => $validatedData['state'],
        ]);

        return redirect()->route('invoices.index')->with('success', 'Factura creada con éxito.');
    }

    // Mostrar una factura específica
    public function show(Invoice $invoice)
    {
        return view('invoices.show', ['invoice' => $invoice]);
    }

    // Actualizar una factura
    public function update(Request $request, Invoice $invoice)
    {
        $validatedData = $request->validate([
            'payment_date' => 'required|date',
            'payment_method' => 'required|string',
            'state' => 'required|string',
        ]);

        $invoice->update($validatedData);

        return redirect()->route('invoices.show', $invoice)->with('success', 'Factura actualizada con éxito.');
    }

    // Eliminar una factura
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('invoices.index')->with('success', 'Factura eliminada con éxito.');
    }
}
