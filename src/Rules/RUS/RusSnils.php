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
        
        $commonDigits = substr($value, 1, 9);
        $controlDigits = substr($value, 1, -2);

        // Additional checking
        // SNILS can't have 3 same digits in each 3-digit parts
        $parts = str_split($commonDigits, 3);
        foreach ($parts as $part) {
            if (preg_match('/(000|111|222|333|444|555|666|777|888|999)/',$part)) {
                return false;
            }
        }

        // Calculate and check control number
        $digits = str_split($commonDigits);

        $weights = [9, 8, 7, 6, 5, 4, 3, 2, 1];
        $sum = 0;
        foreach ($digits as $key => $digit) {
            $sum += $weights[$key] * (int) $digit;
        }
        
        if ($sum > 101) {
            $sum = $sum % 101;
        }
        
        if ($sum < 100) {
            $controlNumber = $sum;
        } else if ($sum == 100 || $sum == 101) {
            $controlNumber = 0;
        }

        return ($controlNumber == ((int) $controlDigits));
    }

}
