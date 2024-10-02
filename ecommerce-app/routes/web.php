<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AppProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Models\AppProfile;


Route::get('/', function () {
    return view('welcome');
});


//admin 

Route::resource('dashboard/profile', AppProfileController::class);
Route::resource('categories', CategoryController::class);

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');


