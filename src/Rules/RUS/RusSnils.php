<?php

namespace Laragrad\IdentifierValidation\Rules\RUS;

use Laragrad\IdentifierValidation\Rules\AbstractRuleExtension;

class RusSnils extends AbstractRuleExtension
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
        if (!preg_match('/^\d{3}-\d{3}-\d{3}(-| )\d{2}$/',$value)) {
            return false;
        }

        $value = str_replace(['-', ' '], ['', ''], $value);

        // Additional checking
        if (preg_match('/(000|111|222|333|444|555|666|777|888|999)/',$value)) {
            return false;
        }

        // Calculate and check control number
        $digits = str_split($value);

        $weights = [9, 8, 7, 6, 5, 4, 3, 2, 1, 0, 0];
        $sum = 0;
        foreach ($digits as $key => $digit) {
            $sum += $weights[$key] * (int) $digit;
        }
        if ($sum < 100) {
            $controlNumber = $sum;
        } else if ($sum == 100 || $sum == 101) {
            $controlNumber = 0;
        } else {
            $controlNumber = $sum % 101;
        }

        return ($controlNumber == ((int) substr($value, 9, 2)));
    }

}