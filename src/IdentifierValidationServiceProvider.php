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

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang/', 'laragrad/identifier-validation');

        // Vendor config and translations publishing
        $this->publishes([
            __DIR__.'/../resources/lang/' => resource_path('lang/vendor/laragrad/identifier-validation'),
            __DIR__.'/../config/identifier-validation.php' => config_path('laragrad/identifier-validation.php'),
        ]);

        // Merge vendor default config with published customized config
        $this->mergeConfigFrom(__DIR__.'/../config/identifier-validation.php', 'laragrad.identifier-validation');

        $this->bootRules();

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

    /**
     * Boot configured rules
     * 
     * @return void
     */
    protected function bootRules()
    {
        $rules = config('laragrad.identifier-validation.rules', []);

        foreach ($rules as $ruleName => $ruleClass) {

            \App::make($ruleClass)->boot($ruleName);

        }
    }
}