<?php

namespace Laragrad\IdentifierValidation\Rules\FRA;

use Laragrad\IdentifierValidation\Rules\AbstractRuleExtension;

class FraSiret extends AbstractRuleExtension
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
        if (!preg_match('/^\d{14}$/',$value)) {
            return false;
        }

        // Calculate and check control number
        $digits = str_split($value);
        $weights = [1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 1];
        $sum = 0;
        foreach ($digits as $key => $digit) {
            $multi = $weights[$key] * (int) $digit;
            if ($multi > 9) {
                $multi = 1 + $multi % 10;
            }
            $sum += $multi;
        }
        $controlNumber = $sum % 5;

        return ($controlNumber == 0);
    }

}
