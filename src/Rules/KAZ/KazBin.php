<?php

namespace Laragrad\IdentifierValidation\Rules\KAZ;

use Laragrad\IdentifierValidation\Rules\AbstractRuleExtension;

class KazBin extends AbstractRuleExtension
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
        if (!preg_match('/^\d{2}[0-1]{1}\d{1}[4-6]{1}[0-4]{1}\d{6}$/',$value)) {
            return false;
        }

        // Calculate and check control number
        $digits = str_split($value);
        $weights = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 0];
        $weights2 = [3, 4, 5, 6, 7, 8, 9, 10, 11, 1, 2, 0];
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

        return ($controlNumber != 10 && $controlNumber == $digits[11]);
    }

}