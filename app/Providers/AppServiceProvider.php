<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\VendorRepositoryInterface;
use App\Repositories\VendorRepository;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\ProductRepository;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(VendorRepositoryInterface::class, VendorRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
