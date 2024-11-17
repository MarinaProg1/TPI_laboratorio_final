<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OpinionController;

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


//Rutas de factura
Route::prefix('invoices')->group(function () {
    Route::get('/', [InvoiceController::class, 'index'])->name('invoices.index'); // Mostrar todas las facturas
    Route::post('/', [InvoiceController::class, 'store'])->name('invoices.store'); // Crear una nueva factura
    Route::get('/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show'); // Mostrar una factura específica
    Route::put('/{invoice}', [InvoiceController::class, 'update'])->name('invoices.update'); // Actualizar una factura
    Route::delete('/{invoice}', [InvoiceController::class, 'destroy'])->name('invoices.destroy'); // Eliminar una factura
});

//Rutas de opinion
Route::prefix('opinions')->group(function () {
    Route::get('/', [OpinionController::class, 'index'])->name('opinions.index'); // Mostrar todas las opiniones
    Route::post('/product/{product}', [OpinionController::class, 'store'])->name('opinions.store'); // Crear una nueva opinión
    Route::get('/{opinion}', [OpinionController::class, 'show'])->name('opinions.show'); // Mostrar una opinión específica
    Route::delete('/{opinion}', [OpinionController::class, 'destroy'])->name('opinions.destroy'); // Eliminar una opinión
});



Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);



require __DIR__.'/auth.php';
