<?php

namespace App\Http\Controllers;

use App\Models\Opinion;
use App\Models\Product;
use Illuminate\Http\Request;

class OpinionController extends Controller
{
    public function index()
    {
        $opinions = Opinion::with('user', 'product')->get();
        return view('opinions.index', compact('opinions'));
    }

    public function show($id)
    {
        $opinion = Opinion::with('user', 'product')->findOrFail($id);
        return view('opinions.show', compact('opinion'));
    }

    public function create()
    {
        $products = Product::all();
        return view('opinions.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'qualification' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:255',
            'date' => 'required|date',
            'product_id' => 'required|exists:products,id',
        ]);

        $opinion = new Opinion($request->all());
        $opinion->user_id = auth()->id();
        $opinion->save();

        return redirect()->route('opinions.index')->with('success', 'Opinión creada con éxito.');
    }

    public function edit($id)
    {
        $opinion = Opinion::findOrFail($id);
        $products = Product::all();
        return view('opinions.edit', compact('opinion', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'qualification' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:255',
            'date' => 'required|date',
             'user_id', 
             'product_id',  
        ]);

        $opinion = Opinion::findOrFail($id);
        $opinion->update($request->all());

        return redirect()->route('opinions.index')->with('success', 'Opinión actualizada con éxito.');
    }

    public function destroy($id)
    {
        $opinion = Opinion::findOrFail($id);
        $opinion->delete();

        return redirect()->route('opinions.index')->with('success', 'Opinión eliminada con éxito.');
    }
}
