<?php

namespace Laragrad\IdentifierValidation\Rules;

use Laragrad\IdentifierValidation\Rules\AbstractRuleExtension;

class Iban extends AbstractRuleExtension
{
    /**
     *
     * {@inheritDoc}
     * @see \Laragrad\IdentifierValidation\Rules\AbstractRuleExtension::extend()
     */
    public function extend($attribute, $value, $parameters, $validator)
    {
        return $this->checkIban($value);
    }

    /**
     * Check IBAN
     *
     * @param mixed $value
     * @return boolean|number
     */
    public function checkIban($value)
    {
        return is_string($value) &&
               $this->checkFormat($value) &&
               $this->checkNationalFormat($value) &&
               $this->checkControlNumber($value);
    }

    /**
     * Check IBAN format
     *
     * @param string $value
     * @return boolean
     */
    protected function checkFormat(string $value)
    {
        return (bool) preg_match('/^[A-Z]{2}\d{2}[A-Z0-9]{1,30}$/',$value);
    }

    /**
     * Check national IBAN format
     *
     * @param string $value
     * @return boolean
     */
    protected function checkNationalFormat(string $value)
    {
        return true;
    }

    /**
     * Check control number
     *
     * @param string $value
     * @return number
     */
    protected function checkControlNumber(string $value)
    {
        $numberIban = $this->convertIban($value);

        $parts = str_split($numberIban, 8);
        $rest = null;

        foreach ($parts as $part) {
            $part = (string) $rest . $part;
            $rest = $part % 97;
        }

        return ($rest === 1);
    }

    /**
     * Convert IBAN to string with replacing alpha to numbers
     *
     * @param string $value
     * @return string
     */
    protected function convertIban(string $value)
    {

        $commonStr = '';
        $partStr = '';
        $digits = str_split($value);
        foreach ($digits as $key => $digit) {
            if ($key < 4) {
                $partStr .= $this->convertSymbol($digit);
            } else {
                $commonStr .= $this->convertSymbol($digit);
            }
        }
        $commonStr .= $partStr;

        return $commonStr;
    }

    /**
     * Convert one IBAN symbol to number string
     *
     * @param string $value
     * @return string
     */
    protected function convertSymbol(string $value)
    {
        return (ord($value) <= 57) ? $value : (string) (10 + ord($value) - 65);
    }

}