<?php

namespace App\Providers;

use App\Services\MediaUploader;
use Illuminate\Support\ServiceProvider;

class MediaUploaderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        $app->singleton('mediaUploader', function ($app) {
            return new MediaUploader();
        });

        $app->alias('mediaUploader', 'App\Services\MediaUploader');
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
