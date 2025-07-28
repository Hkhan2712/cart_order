<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CustomerController;
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
use App\Http\Middleware\CheckRole;

Route::domain('admin.localhost')->name('admin.')->middleware('web')->group(function () {
    // Auth routes
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected routes
    Route::middleware(['auth', CheckRole::class . ':admin, staff, support'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('/products', ProductController::class)->names('products');
        Route::resource('/categories', CategoryController::class)->names('categories');
        Route::resource('/orders', OrderController::class)->names('orders');
        Route::resource('/customers', CustomerController::class)->names('customers');
        Route::resource('/shippings', ShippingProviderController::class)->names('shippings');
        Route::resource('/reviews', ReviewController::class)->names('reviews');
        Route::resource('/inventory', InventoryController::class)->names('inventory');
        Route::resource('/coupons', CouponController::class)->names('coupons');
        Route::resource('/banners', BannerController::class)->names('banners');
        Route::resource('/users', UserController::class)->names('users');
        Route::resource('/notifications', NotificationController::class)->names('notifications');

        Route::get('/settings/general', [SettingController::class, 'general'])->name('settings.general');
        Route::get('/logs', [LogController::class, 'index'])->name('logs.index');
    });
});
