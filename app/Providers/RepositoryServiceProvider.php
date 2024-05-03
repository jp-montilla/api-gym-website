<?php

namespace App\Providers;

use App\Interfaces\StudioRepositoryInterface;
use App\Repositories\StudioRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(StudioRepositoryInterface::class,StudioRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
