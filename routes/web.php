<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OpinionController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('dashtest');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

 // Rutas de productos
  Route::resource('products', ProductsController::class);
  Route::resource('categories', CategoryController::class);
 
  
//Rutas de carrito
Route::resource('carts', CartController::class);
Route::post('/carts/add/{productId}', [CartController::class, 'add'])->name('carts.add');
Route::get('cart/checkout', [CartController::class, 'checkout'])->name('carts.checkout');
Route::post('cart/checkout', [CartController::class, 'processCheckout'])->name('carts.processCheckout');

 //Ruta de facturas
Route::resource('invoices', InvoiceController::class);

//Ruta de opiniones
Route::resource('opinions', OpinionController::class);

//Ruta de ordenes
Route::resource('orders', OrderController::class);

});


Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);



require __DIR__.'/auth.php';
