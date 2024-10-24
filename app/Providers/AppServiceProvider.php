<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

use App\Repositories\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Repositories\StockRepositoryInterface;
use App\Repositories\StockRepository;
use App\Repositories\CustomerRepositoryInterface;
use App\Repositories\CustomerRepository;
use App\Repositories\CartRepositoryInterface;
use App\Repositories\CartRepository;
use App\Repositories\PermissionRepositoryInterface;
use App\Repositories\PermissionRepository;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(StockRepositoryInterface::class, StockRepository::class);
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $cartItemCount = 0; // Default count

            if (Auth::check()) {
                // Get the count of cart items for the authenticated user
                $cartItemCount = app(CartRepositoryInterface::class)
                                ->getCartItemsCountForUser(Auth::id());
            }

            $view->with('cartItemCount', $cartItemCount);
        });
    }
}
