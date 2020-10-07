<?php

namespace Laragrad\IdentifierValidation;

use Illuminate\Support\ServiceProvider;

class IdentifierValidationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang/', 'laragrad/identifier_validation');

        $this->publishes([
            __DIR__.'/../resources/lang/' => resource_path('lang/laragrad'),
            __DIR__.'/../config/identifier_validation.php' => config_path('laragrad/identifier_validation.php'),
        ]);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}