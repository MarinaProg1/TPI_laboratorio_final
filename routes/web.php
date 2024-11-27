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
    
   
    Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductsController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductsController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [ProductsController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductsController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductsController::class, 'destroy'])->name('products.destroy');
    Route::get('/products/{id}', [ProductsController::class, 'show'])->name('products.show');
    

  
//Rutas de carrito
Route::resource('carts', CartController::class);
Route::post('/carts/add/{productId}', [CartController::class, 'add'])->name('carts.add');
Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('carts.remove');
Route::get('cart/checkout', [CartController::class, 'checkout'])->name('carts.checkout');
Route::post('cart/checkout', [CartController::class, 'processCheckout'])->name('carts.processCheckout');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');


// Rutas de facturas
Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
Route::get('/invoices/{id}', [InvoiceController::class, 'show'])->name('invoices.show');
Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoices.store');
Route::get('/invoices/{id}/edit', [InvoiceController::class, 'edit'])->name('invoices.edit');
Route::put('/invoices/{id}', [InvoiceController::class, 'update'])->name('invoices.update');
Route::delete('/invoices/{id}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');


//Rutas de opiniones
Route::get('/opinions', [OpinionController::class, 'index'])->name('opinions.index');
Route::get('/opinions/{id}', [OpinionController::class, 'show'])->name('opinions.show');
Route::get('/opinions/create', [OpinionController::class, 'create'])->name('opinions.create');
Route::post('/opinions', [OpinionController::class, 'store'])->name('opinions.store');
Route::get('/opinions/{id}/edit', [OpinionController::class, 'edit'])->name('opinions.edit');
Route::put('/opinions/{id}', [OpinionController::class, 'update'])->name('opinions.update');
Route::delete('/opinions/{id}', [OpinionController::class, 'destroy'])->name('opinions.destroy');

// Rutas de ordenes
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
Route::put('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');
Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');


});


Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);



require __DIR__.'/auth.php';
