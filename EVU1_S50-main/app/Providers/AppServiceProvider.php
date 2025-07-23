<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\UFService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(UFService::class, function ($app) {
            return new UFService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
