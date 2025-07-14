<?php

use App\Http\Controllers\Web\CategoryViewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\ProductViewController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductViewController::class, 'index'])->name('index');
    Route::get('/{slug}', [ProductViewController::class, 'show'])->name('show');
});
Route::prefix('categories')->name('categories.')->group(function () {
    Route::get('/', [CategoryViewController::class, 'index'])->name('index');
    Route::get('/{slug}', [CategoryViewController::class, 'show'])->name('show');
});

