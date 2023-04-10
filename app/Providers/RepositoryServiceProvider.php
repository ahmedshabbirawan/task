<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\BusinessRepositoryInterface;
use App\Repositories\BusinessRepository;

use App\Interfaces\CustomerOrderRepositoryInterface;
use App\Repositories\CustomerOrderRepository;

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
