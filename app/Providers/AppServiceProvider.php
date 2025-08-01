<?php

namespace App\Providers;

use App\Repositories\UserAddressRepo;
use App\Services\Shipping\ShippingFeeCalculator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(UserAddressRepo::class, function ($app) {
            return new UserAddressRepo();
        });
    }


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrapFive();
    }
}
