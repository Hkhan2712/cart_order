<?php

use App\Http\Controllers\Web\CategoryViewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\ProductViewController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\CartViewController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\UserAddressController;
use App\Http\Controllers\Web\OrderViewController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('products')->name('products.')->group(function () {
    Route::get('/search', [ProductViewController::class, 'search'])->name('search');
    Route::get('/', [ProductViewController::class, 'index'])->name('index');
    Route::get('/{slug}', [ProductViewController::class, 'show'])
        ->where('slug', '^(?!search$).+')
        ->name('show');
    Route::post('/filter', [ProductViewController::class, 'ajaxFilter'])->name('filter');
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
    Route::post('/update', [CartController::class, 'update'])->name('update');
});

// Checkout 
// Route::get('/checkout', [OrderViewController::class, 'index'])->name('checkout.index');
Route::prefix('order')->name('order.')->group(function () {
    Route::get('/', [OrderViewController::class, 'index'])->name('index');
    Route::post('/process', [OrderViewController::class, 'process'])->name('process');
});

// Addresses
Route::middleware('auth')->get('/user-address', [UserAddressController::class, 'index']);