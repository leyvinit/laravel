<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;







Route::get('/users', [UserController::class, 'index']);
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/cars', [CarController::class, 'index']);
Route::resource('tasks', TaskController::class);
Route::resource('products', ProductController::class);
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');





