<?php

namespace App\Providers;

use App\Services\Geo;
use Illuminate\Support\ServiceProvider;

class GeoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        $app->singleton('geo', function ($app) {
            return new Geo();
        });

        $app->alias('geo', 'App\Services\Geo');
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
