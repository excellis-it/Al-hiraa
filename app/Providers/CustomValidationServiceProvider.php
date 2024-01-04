<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class CustomValidationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        Validator::extend('password', function ($attribute, $value, $parameters, $validator) {
            return \Hash::check($value, current($parameters));
        });

        Validator::replacer('password', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':other', $parameters[0], $message);
        });
    }

}
