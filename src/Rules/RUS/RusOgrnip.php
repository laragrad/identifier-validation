<?php

namespace Laragrad\IdentifierValidation\Rules\RUS;

use Laragrad\IdentifierValidation\Rules\AbstractRuleExtension;

class RusOgrnip extends AbstractRuleExtension
{
    /**
     *
     * {@inheritDoc}
     * @see \Laragrad\IdentifierValidation\Rules\AbstractRuleExtension::extend()
     */
    public function extend($attribute, $value, $parameters, $validator)
    {
        // Check for is a string
        if (!is_string($value)) {
            return false;
        }

        // Check format
        if (!preg_match('/^\d{15}$/',$value)) {
            return false;
        }

        // Calculate and check control number
        $digits = str_split($value);
        $controlNumber = ((int) substr($value, 0, 14)) % 13 % 10;

        return ($controlNumber == $digits[14]);
    }

}