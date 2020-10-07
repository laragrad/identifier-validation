<?php

namespace Laragrad\IdentifierValidation\Rules;

use Laragrad\IdentifierValidation\Rules\AbstractRuleExtension;

class BankCardNumber extends AbstractRuleExtension
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

        // Remove spaces and separators
        $value = str_replace([' ', '-'], ['', ''], $value);

        // Check fromat
        if (!preg_match('/^(\d{16}|\d{13})$/',$value)) {
            return false;
        }

        $digits = str_split($value);

        // Calculate and check control number
        $len = count($digits);
        $weights = [2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1];
        $sum = 0;
        for ($i = 0; $i < $len; $i++) {
            $x = $weights[(15 - $i)] * (int) $digits[($len - 1 - $i)];
            if ($x > 9) {
                $x = $x - 9;
            }
            $sum += $x;
        }
        $controlNumber = $sum % 10;

        return ($controlNumber == 0);
    }

}