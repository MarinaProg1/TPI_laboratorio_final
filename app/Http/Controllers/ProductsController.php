<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
{
    // Validar los datos del formulario
    $validated = $request->validate([
        'name' => 'required|string|max:255|unique:products,name',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'category_id' => 'required|exists:categories,id', 
        'stock' => 'required|integer|min:0', 
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
    }

    // Crear y guardar el producto
    $product = Product::create([
        'name' => $validated['name'],
        'price' => $validated['price'],
        'description' => $validated['description'],
        'category_id' => $validated['category_id'],
        'stock' => $validated['stock'],
        'image' => $imagePath, // Guarda la ruta relativa de la imagen
    ]);

    // Redirigir con mensaje de éxito
    return redirect()->route('products.index')->with('success', 'Producto creado correctamente.');
}


    public function edit($id)
    {
        $product = Product::findOrFail($id); // Busca el producto o lanza un error 404
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => 'required|integer|min:0', // Validar el campo 'stock'
        ]);

        $product = Product::findOrFail($id);

        // Manejar la imagen si se sube una nueva
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        // Actualizar los datos del producto
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock, // Actualizar el valor de 'stock'
            'image' => $product->image, // Mantener la imagen si no se sube una nueva
        ]);

        return redirect()->route('products.index')->with('success', 'Producto actualizado correctamente');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Producto eliminado correctamente');
    }
}
