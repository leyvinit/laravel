<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\TaskController;




Route::get('/users', [UserController::class, 'index']);
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/cars', [CarController::class, 'index']);
Route::resource('tasks', TaskController::class);



