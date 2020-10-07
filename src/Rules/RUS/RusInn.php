<?php

namespace Laragrad\IdentifierValidation\Rules\RUS;

use Laragrad\IdentifierValidation\Rules\AbstractRuleExtension;

class RusInn extends AbstractRuleExtension
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
        $weights = [2, 4, 10, 3, 5, 9, 4, 6, 8, 0];
        $sum = 0;
        foreach ($digits as $key => $digit) {
            $sum += $weights[$key] * (int) $digit;
        }
        $controlNumber = $sum % 11 % 10;

        return ($controlNumber == $digits[9]);
    }

}