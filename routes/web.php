<?php

// ADMIN

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ShippingProviderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Web\CategoryViewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\ProductViewController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\CartViewController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\UserAddressController;
use App\Http\Controllers\Web\OrderViewController;
use App\Http\Middleware\CheckRole;

Route::domain('admin.localhost')
    ->middleware(['web', 'auth', CheckRole::class . ':admin, staff, support']) 
    ->prefix('/') 
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        
    });

// Route::prefix('admin')->middleware(['auth', CheckRole::class . ':admin, staff, support'])->name('admin.')->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
//     Route::resource('/products', ProductController::class);
//     Route::resource('/categories', CategoryController::class);
//     Route::resource('/orders', OrderController::class);
//     Route::resource('/users', UserController::class);
//     Route::resource('/shippings', ShippingProviderController::class);
//     Route::resource('/reviews', ReviewController::class);
//     Route::resource('/inventory', InventoryController::class);
//     Route::resource('/coupons', CouponController::class);
//     Route::resource('/banners', BannerController::class);
//     Route::resource('/admins', AdminController::class);
//     Route::resource('/notifications', NotificationController::class);

//     Route::get('/settings/general', [SettingController::class, 'general'])->name('settings.general');
//     Route::get('/logs', [LogController::class, 'index'])->name('logs.index');
// });
Route::prefix('/admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/products', ProductController::class);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/orders', OrderController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/shippings', ShippingProviderController::class);
    Route::resource('/reviews', ReviewController::class);
    Route::resource('/inventory', InventoryController::class);
    Route::resource('/coupons', CouponController::class);
    Route::resource('/banners', BannerController::class);
    Route::resource('/admins', AdminController::class);
    Route::resource('/notifications', NotificationController::class);

    Route::get('/settings/general', [SettingController::class, 'general'])->name('settings.general');
    Route::get('/logs', [LogController::class, 'index'])->name('logs.index');
});

// Route::get('/', [HomeController::class, 'index'])->name('home');

// Route::prefix('products')->name('products.')->group(function () {
//     Route::get('/search', [ProductViewController::class, 'search'])->name('search');
//     Route::get('/', [ProductViewController::class, 'index'])->name('index');
//     Route::get('/{slug}', [ProductViewController::class, 'show'])
//         ->where('slug', '^(?!search$).+')
//         ->name('show');
//     Route::post('/filter', [ProductViewController::class, 'ajaxFilter'])->name('filter');
// });

// Route::prefix('categories')->name('categories.')->group(function () {
//     Route::get('/', [CategoryViewController::class, 'index'])->name('index');
//     Route::get('/{slug}', [CategoryViewController::class, 'show'])->name('show');
// });

// // Authentication
// Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
// Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
// Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// // Google Login 
// Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
// Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

// // Cart
// Route::get('/cart', [CartViewController::class, 'index'])->name('cart.index');
// // Cart AJAX 
// Route::prefix('cart')->name('cart.')->group(function () {
//     Route::post('/add', [CartController::class, 'add'])->name('add');
//     Route::post('/remove', [CartController::class, 'remove'])->name('remove');
//     Route::get('/mini', [CartController::class, 'miniCart'])->name('mini');
//     Route::post('/update', [CartController::class, 'update'])->name('update');
// });

// // Checkout 
// // Route::get('/checkout', [OrderViewController::class, 'index'])->name('checkout.index');
// Route::prefix('checkout')->name('checkout.')->group(function () {
//     Route::get('/', [OrderViewController::class, 'index'])->name('index');
//     Route::post('/process', [OrderViewController::class, 'process'])->name('process');
// });

// // Addresses
// Route::middleware('auth')->get('/user-address', [UserAddressController::class, 'index']);

// require __DIR__ . '/admin.php';
