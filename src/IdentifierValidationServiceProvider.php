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

    protected function bootRules()
    {
        $rules = config('laragrad.identifier-validation.rules', []);

        foreach ($rules as $ruleName => $ruleClass) {

//             \Validator::extend($ruleName, function (...$params) use ($ruleClass) {
//                 return $ruleClass::extend(...$params);
//             });

//             if (method_exists($ruleClass, 'replacer')) {

//                 // Custom rule replacer
//                 \Validator::replacer($ruleName, function (...$params) use ($ruleClass)  {
//                     return $ruleClass::replacer(...$params);
//                 });

//             } else {

//                 // Default rule replacer
//                 \Validator::replacer($ruleName, function ($message, $attribute, $rule, $parameters, $validator) use ($ruleName) {
//                     return trans(
//                         'laragrad/identifier-validation::validation.'.$ruleName,
//                         ['attribute' => $attribute]
//                     );
//                 });

//             }

            \App::make($ruleClass)->boot($ruleName);

        }
    }
}