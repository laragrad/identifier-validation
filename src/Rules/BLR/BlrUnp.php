<?php

namespace Laragrad\IdentifierValidation\Rules\BLR;

use Laragrad\IdentifierValidation\Rules\AbstractRuleExtension;

class BlrUnp extends AbstractRuleExtension
{
    /**
     *
     * {@inheritDoc}
     * @see \Laragrad\IdentifierValidation\Rules\AbstractRuleExtension::extend()
     */
    public function extend($attribute, $value, $parameters, $validator)
    {
        // Check for string
        if (!is_string($value)) {
            return false;
        }

        // Check fromat
        if (!preg_match('/^\d{9}$/',$value)) {
            return false;
        }

        // Calculate and check control number
        $digits = str_split($value);
        $weights = [29, 23, 19, 17, 13, 7, 5, 3, 0];
        $sum = 0;
        foreach ($digits as $key => $digit) {
            $sum += $weights[$key] * (int) $digit;
        }
        $controlNumber = $sum % 11 % 10;

        return ($controlNumber != 10 && $controlNumber == $digits[8]);
    }
}