<?php

namespace App\Http\Controllers;
use App\Models\Product; 
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    
        public function index()
        {
            $products = Product::all();
    
            return view('products.index', compact('products'));
    
        }
    
        public function create()
        {
    
            return view('products.create');
    
        }
    
        public function store(Request $request)
        {
            $request->validate([
                'name'=>'required',
                'price'=>'required'|'numeric',
                'description'=>'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' 
    
            ]);
    
            
        $imagePath = $request->file('image')->store('products', 'public'); // Almacenarla en `storage/app/public/products`
    
        
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath,
        ]);
    
        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }


public function edit($id)
    {
        $product = Product::findOrFail($id); // Busca el producto o lanza un error 404
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $product->image, 
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete(); 
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
