<?php

namespace App\Http\Controllers;

use App\Models\Opinion;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OpinionController extends Controller
{
    // Mostrar todas las opiniones
    public function index()
    {
        $opinions = Opinion::with(['user', 'product'])->get();
        return view('opinions.index', ['opinions' => $opinions]);
    }

    // Crear una nueva opinión para un producto específico
    public function store(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'qualification' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        $opinion = new Opinion($validatedData);
        $opinion->user_id = Auth::id(); // Asocia la opinión al usuario autenticado
        $opinion->product_id = $product->id;
        $opinion->save();

        return redirect()->route('opinions.index')->with('success', 'Opinión agregada con éxito.');
    }

    // Mostrar una opinión específica
    public function show(Opinion $opinion)
    {
        return view('opinions.show', ['opinion' => $opinion]);
    }

    // Eliminar una opinión
    public function destroy(Opinion $opinion)
    {
        if (Auth::id() === $opinion->user_id) {
            $opinion->delete();
            return redirect()->route('opinions.index')->with('success', 'Opinión eliminada con éxito.');
        }

        return redirect()->route('opinions.index')->with('error', 'No tienes permiso para eliminar esta opinión.');
    }
}
