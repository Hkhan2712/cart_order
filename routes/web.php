<?php

use App\Http\Controllers\Web\CategoryViewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\ProductViewController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\CartViewController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Web\CheckoutViewController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductViewController::class, 'index'])->name('index');
    Route::get('/{slug}', [ProductViewController::class, 'show'])->name('show');
});
Route::prefix('categories')->name('categories.')->group(function () {
    Route::get('/', [CategoryViewController::class, 'index'])->name('index');
    Route::get('/{slug}', [CategoryViewController::class, 'show'])->name('show');
});

// Authentication
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Google Login 
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

// Cart
Route::get('/cart', [CartViewController::class, 'index'])->name('cart.index');
// Cart AJAX 
Route::prefix('cart')->name('cart.')->group(function () {
    Route::post('/add', [CartController::class, 'add'])->name('add');
    Route::post('/remove', [CartController::class, 'remove'])->name('remove');
    Route::get('/mini', [CartController::class, 'miniCart'])->name('mini');
});

// Checkout 
Route::get('/checkout', [CheckoutViewController::class, 'index'])->name('checkout.index');

