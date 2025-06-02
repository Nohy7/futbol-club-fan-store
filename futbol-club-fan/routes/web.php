<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/index', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('index');
});

Route::get('/productos', [ProductController::class, 'index']);
Route::get('/usuario', [ProductController::class, 'index']);
