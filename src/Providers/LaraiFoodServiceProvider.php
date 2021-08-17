<?php

namespace BeeDelivery\LaraiFood\Providers;

use BeeDelivery\LaraiFood\LaraiFood;
use Illuminate\Support\ServiceProvider;

class LaraiFoodServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/laraifood.php' => config_path('laraifood.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/laraifood.php', 'laraifood');

        // Register the service the package provides.
        $this->app->singleton('laraifood', function ($app) {
            return new LaraiFood;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laraifood'];
    }
}
