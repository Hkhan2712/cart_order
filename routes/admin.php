<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Middleware\CheckRole;

Route::domain('admin.localhost')
    ->middleware(['web', 'auth', CheckRole::class . ':admin, staff, support']) 
    ->prefix('/') 
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        
    });

