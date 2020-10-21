<?php

namespace Laragrad\IdentifierValidation\Rules\UKR;

use Laragrad\IdentifierValidation\Rules\AbstractRuleExtension;

class UkrRnokpp extends AbstractRuleExtension
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
        if (!preg_match('/^\d{10}$/',$value)) {
            return false;
        }

        // Calculate and check control number
        $digits = str_split($value);
        $weights = [-1, 5, 7, 9, 4, 6, 10, 5, 7, 0];

        $sum = 0;
        foreach ($digits as $key => $digit) {
            $sum += $weights[$key] * (int) $digit;
        }
        $controlNumber = $sum % 11 % 10;

        return ($controlNumber == $digits[9]);
    }

}