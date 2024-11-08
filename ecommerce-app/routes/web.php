<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AppProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductItemController;

Route::get('/', function () {
    return view('welcome');
});



Route::resource('dashboard/profile', AppProfileController::class);
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('productItem', ProductItemController::class);
Route::post('/products/bulk-action', [ProductController::class, 'bulkAction'])->name('products.bulkAction');
Route::put('products/toggleStatus/{id}', [ProductController::class, 'toggleStatus']);
Route::put ('productItem/toggleStatus/{id}',[ProductItemController::class, 'toggleStatus']);



Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');


