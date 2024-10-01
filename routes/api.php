<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories', 'index');
    Route::post('/categories', 'store');
    Route::get('/categories/{id}', 'destroy');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'index');
    Route::post('/products', 'store');
    Route::get('/products/{id}', 'destroy');
});

Route::controller(MenuController::class)->group(function () {
    Route::get('/menus', 'list');
});

Route::controller(OrderController::class)->group(function () {
    Route::get('/orders', 'index');
    Route::post('/orders', 'store');
    Route::get('/orders/{order}', 'show');
    Route::patch('/orders/{order}', 'updateStatus');
});


