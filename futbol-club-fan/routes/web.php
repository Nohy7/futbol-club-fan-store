<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;



Route::get('/', function () {
    return view('index');
});

Route::get('/productos', [ProductController::class, 'indexPage'])->name('product.index');
Route::get('/productos/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/usuario', [ProductController::class, 'index']);


Route::get('/ingreso', function () {
    return view('login.login');
});

Route::get('/registro', function () {
    return view('login.registration');
});

Route::get('/privada', function () {
    return view('private');
});

Route::post('/registration', [LoginController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/order', [OrderController::class, 'store'])->name('order.create')->middleware('auth');
