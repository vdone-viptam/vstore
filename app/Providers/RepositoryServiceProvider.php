<?php

namespace App\Providers;

use App\Interfaces\API\ReviewProduct\ReviewProductRepositoryInterface;
use App\Repositories\API\ReviewProduct\ReviewProductRepository;
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
