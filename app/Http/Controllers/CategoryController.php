<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

   
    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

       
        Category::create($validated);

        
        return redirect()->route('categories.index')->with('success', 'Categoría creada correctamente.');
    }

    
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    
    public function update(Request $request, Category $category)
    {
       
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

   
        $category->update($validated);

       
        return redirect()->route('categories.index')->with('success', 'Categoría actualizada correctamente.');
    }

  

    public function destroy(Category $category)
    {
      
        $category->delete();

       
        return redirect()->route('categories.index')->with('success', 'Categoría eliminada correctamente.');
    }
}
