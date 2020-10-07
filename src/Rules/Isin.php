<?php

namespace Laragrad\IdentifierValidation\Rules;

use Laragrad\IdentifierValidation\Rules\AbstractRuleExtension;

class Isin extends AbstractRuleExtension
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
        if (!preg_match('/^[A-Z]{2}\d{10}$/',$value)) {
            return false;
        }

        $a1 = (string) (ord(substr($value, 0, 1)) - ord('A') + 10);
        $a2 = (string) (ord(substr($value, 1, 1)) - ord('A') + 10);
        $value = $a1.$a2.substr($value, 2);

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