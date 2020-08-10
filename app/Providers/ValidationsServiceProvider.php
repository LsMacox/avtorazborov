<?php

namespace App\Providers;

use App\Validations\CustomValidator;
use Illuminate\Support\ServiceProvider;
use Validator;

class ValidationsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::resolver(function($translator, $data, $rules, $messages, $attributes){
            return new CustomValidator($translator, $data, $rules, $messages, $attributes);
        });
    }
}
