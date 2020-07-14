<?php

namespace App\Providers;

use App\Repositories\Interfaces\PropertyAnalyticRepositoryInterface;
use App\Repositories\Interfaces\PropertyRepositoryInterface;
use App\Repositories\PropertyAnalyticRepository;
use App\Repositories\PropertyRepository;
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
        $this->app->bind(
            PropertyRepositoryInterface::class,
            PropertyRepository::class
        );
        $this->app->bind(
            PropertyAnalyticRepositoryInterface::class,
            PropertyAnalyticRepository::class
        );
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
