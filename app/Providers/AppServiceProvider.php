<?php

namespace App\Providers;

use App\Repositories\Eloquent\CartItemRepo;
use App\Repositories\Eloquent\CartRepo;
use App\Repositories\Eloquent\CategoryRepo;
use App\Repositories\Eloquent\CouponRepo;
use App\Repositories\Eloquent\InventoryRepo;
use App\Repositories\Eloquent\OrderItemRepo;
use App\Repositories\Eloquent\OrderRepo;
use App\Repositories\Eloquent\OrderStatusRepo;
use App\Repositories\Eloquent\PaymentRepo;
use App\Repositories\Eloquent\ProductImgRepo;
use App\Repositories\Eloquent\ProductRepo;
use App\Repositories\Eloquent\ReviewRepo;
use App\Repositories\Eloquent\RoleRepo;
use App\Repositories\Eloquent\ShippingProviderRepo;
use App\Repositories\Eloquent\ShippingRepo;
use App\Repositories\Eloquent\UserRepo;
use App\Repositories\Interfaces\CartItemRepoInterface;
use App\Repositories\Interfaces\CartRepoInterface;
use App\Repositories\Interfaces\CategoryRepoInterface;
use App\Repositories\Interfaces\CouponRepoInterface;
use App\Repositories\Interfaces\InventoryLogRepoInterface;
use App\Repositories\Interfaces\OrderItemRepoInterface;
use App\Repositories\Interfaces\OrderRepoInterface;
use App\Repositories\Interfaces\OrderStatusRepoInterface;
use App\Repositories\Interfaces\PaymentRepoInterface;
use App\Repositories\Interfaces\ProductImgRepoInterface;
use App\Repositories\Interfaces\ProductRepoInterface;
use App\Repositories\Interfaces\ReviewRepoInterface;
use App\Repositories\Interfaces\RoleRepoInterface;
use App\Repositories\Interfaces\ShippingProviderRepoInterface;
use App\Repositories\Interfaces\ShippingRepoInterface;
use App\Repositories\Interfaces\UserRepoInterface;
use App\Services\Eloquent\CartService;
use App\Services\Eloquent\CategoryService;
use App\Services\Eloquent\HomeService;
use App\Services\Eloquent\OrderService;
use App\Services\Eloquent\ProductService;
use App\Services\Eloquent\UserService;
use App\Services\Interfaces\CartServiceInterface;
use App\Services\Interfaces\CategoryServiceInterface;
use App\Services\Interfaces\HomeServiceInterface;
use App\Services\Interfaces\OrderServiceInterface;
use App\Services\Interfaces\ProductServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $bindings = [
            // Repositories
            RoleRepoInterface::class            => RoleRepo::class,
            UserRepoInterface::class            => UserRepo::class,
            ShippingRepoInterface::class        => ShippingRepo::class,
            CategoryRepoInterface::class        => CategoryRepo::class,
            ProductRepoInterface::class         => ProductRepo::class,
            ProductImgRepoInterface::class      => ProductImgRepo::class,
            CartRepoInterface::class            => CartRepo::class,
            CartItemRepoInterface::class        => CartItemRepo::class,
            OrderRepoInterface::class           => OrderRepo::class,
            OrderItemRepoInterface::class       => OrderItemRepo::class,
            PaymentRepoInterface::class         => PaymentRepo::class,
            CouponRepoInterface::class          => CouponRepo::class,
            ReviewRepoInterface::class          => ReviewRepo::class,
            InventoryLogRepoInterface::class    => InventoryRepo::class,
            OrderStatusRepoInterface::class     => OrderStatusRepo::class,
            ShippingProviderRepoInterface::class=> ShippingProviderRepo::class,

            // Services
            CartServiceInterface::class => CartService::class,
            CategoryServiceInterface::class => CategoryService::class,
            HomeServiceInterface::class => HomeService::class,
            OrderServiceInterface::class => OrderService::class,
            ProductServiceInterface::class => ProductService::class,
            UserServiceInterface::class => UserService::class,
        ];

        foreach ($bindings as $interface => $implementation) {
            $this->app->singleton($interface, $implementation);
        }
    }


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
