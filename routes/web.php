<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoryController;

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
 Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
 Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
 Route::put('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
 Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');


});
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);



require __DIR__.'/auth.php';
