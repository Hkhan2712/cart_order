<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\ProductViewController;
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductViewController::class, 'index'])->name('index');
    Route::get('/{slug}', [ProductViewController::class, 'show'])->name('show');
});

