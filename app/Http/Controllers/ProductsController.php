<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $categoryId = $request->input('category_id');
        
        $products = Product::query();

        if ($categoryId) {
            $products = $products->where('category_id', $categoryId);
        }

        $products = $products->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
{
   
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

    $product = Product::create([
        'name' => $validated['name'],
        'price' => $validated['price'],
        'description' => $validated['description'],
        'category_id' => $validated['category_id'],
        'stock' => $validated['stock'],
        'image' => $imagePath, 
    ]);

    // Redirigir con mensaje de éxito
    return redirect()->route('products.index')->with('success', 'Producto creado correctamente.');
}


    public function edit($id)
    {
        $product = Product::findOrFail($id); 
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        
        $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => 'required|integer|min:0', 
        ]);

        $product = Product::findOrFail($id);

        // Manejar la imagen si se sube una nueva
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }


        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock, 
            'image' => $product->image, 
        ]);

        return redirect()->route('products.index')->with('success', 'Producto actualizado correctamente');
    }

    
       public function destroy($id)
    { 
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Producto eliminado correctamente');
    }

    public function show($id)
    {
        $product = Product::with('opinions.user')->find($id); 
        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Producto no encontrado');
        }
    
        return view('products.show', compact('product'));
    }
    
}
