<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\NowPaymentsService;

class NowPaymentsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(NowPaymentsService::class, function ($app) {
            return new NowPaymentsService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
