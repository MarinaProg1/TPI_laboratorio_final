<?php

namespace App\Http\Controllers;

use App\Models\Opinion;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; 

class OpinionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

  
    public function index($productId = null)
{
    if ($productId) {
        $product = Product::with(['opinions' => function ($query) {
            $query->orderBy('created_at', 'desc'); // Orden descendente por fecha
        }, 'opinions.user'])->findOrFail($productId);

        $opinions = $product->opinions;
    } else {
        $opinions = Opinion::with(['user', 'product'])
                           ->orderBy('created_at', 'desc') // Orden descendente por fecha
                           ->get();
        $product = null;
    }

    return view('opinions.index', compact('opinions', 'product'));
}



   public function create(Product $product)
{
    return view('opinions.create', compact('product'));
}


    public function show($id)
    {
        $opinion = Opinion::with('user', 'product')->findOrFail($id);
        return view('opinions.show', compact('opinion'));
    }

    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'comment' => 'required|string|max:1000',
            'qualification' => 'required|integer|min:1|max:5',
        ]);

        // Crear la opinión
        Opinion::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'comment' => $request->comment,
            'qualification' => $request->qualification,
            'date' => Carbon::now(),
        ]);
$product = Product::findOrFail($request->product_id);

return redirect()->route('products.show', $product)
                 ->with('success', 'Opinión guardada correctamente.');

    }
}
