<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\BusinessRepositoryInterface;
use App\Repositories\BusinessRepository;

use App\Interfaces\CustomerOrderRepositoryInterface;
use App\Repositories\CustomerOrderRepository;

use App\Interfaces\ProductRepositoryInterface;
use App\Repositories\ProductRepository;


use App\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BusinessRepositoryInterface::class, BusinessRepository::class);
        $this->app->bind(CustomerOrderRepositoryInterface::class, CustomerOrderRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
