<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();
        return view('invoices.index', compact('invoices'));
    }

    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('invoices.show', compact('invoice'));
    }

    public function create()
    {
        return view('invoices.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_date' => 'required|date',
            'payment_method' => 'required|string',
            'state' => 'required|string',
        ]);

        Invoice::create($request->all());

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
