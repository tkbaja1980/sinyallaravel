<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
                
            // Include payment routes
            Route::middleware('web')
                ->group(base_path('routes/payment.php'));
                
            // Include crypto payment routes
            Route::middleware('web')
                ->group(base_path('routes/crypto_payment.php'));
                
            // Include API payment routes
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api_payment.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        // Configure rate limiting if needed
    }
}
