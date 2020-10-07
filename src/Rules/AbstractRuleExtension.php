<?php

namespace Laragrad\IdentifierValidation\Rules;

use \Illuminate\Support\Str;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;

abstract class AbstractRuleExtension
{

    /**
     * Rule extension booting
     *
     * @param string $rule
     */
    public function boot(string $rule = null)
    {
        $rule = $rule ?? \Str::snake(get_class($this));

        \Validator::extend($rule, function (...$params) {
            return $this->extend(...$params);
        });

        \Validator::replacer($rule, function (...$params) {
            return $this->replacer(...$params);
        });
    }

    /**
     *
     * @param string $attribute
     * @param mixed $value
     * @param array $parameters
     * @param ValidatorContract $validator
     */
    abstract public function extend($attribute, $value, $parameters, $validator);

    /**
     * Default message replacer
     *
     * @param string $message
     * @param string $attribute
     * @param string $rule
     * @param array $parameters
     * @param ValidatorContract $validator
     * @return string
     */
    public function replacer($message, $attribute, $rule, $parameters, $validator)
    {
        $attributeName = $validator->customAttributes[$attribute] ?? $attribute;

        return trans(
            'laragrad/identifier-validation::validation.'.$rule,
            ['attribute' => $attributeName]
        );
    }

}