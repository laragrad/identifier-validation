<?php

namespace Laragrad\IdentifierValidation\Rules\UKR;

use Laragrad\IdentifierValidation\Rules\AbstractRuleExtension;

class UkrEdrpou extends AbstractRuleExtension
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
        if (!preg_match('/^\d{8}$/',$value)) {
            return false;
        }

        // Calculate and check control number
        $digits = str_split($value);
        if ($digits[0] < 3 || $digits[0] > 6) {
            $weights = [1, 2, 3, 4, 5, 6, 7, 0];
            $weights2 = [3, 4, 5, 6, 7, 8, 9, 0];
        } else {
            $weights = [7, 1, 2, 3, 4, 5, 6, 0];
            $weights2 = [9, 3, 4, 5, 6, 7, 8, 0];
        }

        $sum = 0;
        $sum2 = 0;
        foreach ($digits as $key => $digit) {
            $sum += $weights[$key] * (int) $digit;
            $sum2 += $weights2[$key] * (int) $digit;
        }
        $controlNumber = $sum % 11;
        if ($controlNumber == 10) {
            $controlNumber = $sum2 % 11;
        }

        return ($controlNumber != 10 && $controlNumber == $digits[7]);
    }

}