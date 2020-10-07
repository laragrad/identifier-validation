<?php

namespace Laragrad\IdentifierValidation\Rules\RUS;

use Laragrad\IdentifierValidation\Rules\AbstractRuleExtension;

class RusPersonInn extends AbstractRuleExtension
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
        if (!preg_match('/^\d{12}$/',$value)) {
            return false;
        }

        // Calculate control number 1
        $digits = str_split($value);
        $weights = [7, 2, 4, 10, 3, 5, 9, 4, 6, 8, 0, 0];
        $sum = 0;
        foreach ($digits as $key => $digit) {
            $sum += $weights[$key] * (int) $digit;
        }
        $controlNumber1 = $sum % 11 % 10;

        // Calculate control number 2
        $weights = [3, 7, 2, 4, 10, 3, 5, 9, 4, 6, 8, 0];
        $sum = 0;
        foreach ($digits as $key => $digit) {
            $sum += $weights[$key] * (int) $digit;
        }
        $controlNumber2 = $sum % 11 % 10;

        // Check control numbers
        return ($controlNumber1 == $digits[10] && $controlNumber2 == $digits[11]);
    }

}