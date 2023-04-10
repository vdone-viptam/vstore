<?php

namespace App\Providers;

use App\Interfaces\API\ReviewProduct\ReviewProductRepositoryInterface;
use App\Interfaces\BigStore\CallApiRepositoryInterface;
use App\Interfaces\Chart\ChartRepositoryInterface;
use App\Interfaces\Storage\Partner\PartnerRepositoryInterface;
use App\Repositories\API\ReviewProduct\ReviewProductRepository;
use App\Repositories\BigStore\CallApiRepository;
use App\Repositories\Chart\ChartRepository;
use App\Repositories\Storage\Partner\PartnerRepository;
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
        $this->app->bind(PartnerRepositoryInterface::class, PartnerRepository::class);
        $this->app->bind(ChartRepositoryInterface::class, ChartRepository::class);
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
