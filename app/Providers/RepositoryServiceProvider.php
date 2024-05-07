<?php

namespace App\Providers;

use App\Interfaces\BlogRepositoryInterface;
use App\Interfaces\CoachRepositoryInterface;
use App\Interfaces\StudioRepositoryInterface;
use App\Repositories\BlogRepository;
use App\Repositories\CoachRepository;
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
        $this->app->bind(CoachRepositoryInterface::class,CoachRepository::class);
        $this->app->bind(BlogRepositoryInterface::class,BlogRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
