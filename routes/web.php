<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\CategoriesController;
use \App\Http\Controllers\BrandsController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth:sanctum'])->group(function(){
    // CATEGORY
    Route::resource('categories', CategoriesController::class);
    // BRAND
    Route::resource('brands', BrandsController::class);
});

