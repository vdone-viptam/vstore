<?php

namespace App\Providers;

use App\Interfaces\API\ReviewProduct\ReviewProductRepositoryInterface;
use App\Interfaces\BigStore\CallApiRepositoryInterface;

use App\Repositories\API\ReviewProduct\ReviewProductRepository;
use App\Repositories\BigStore\CallApiRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ReviewProductRepositoryInterface::class, ReviewProductRepository::class);
        $this->app->bind(CallApiRepositoryInterface::class, CallApiRepository::class);
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
