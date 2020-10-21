<?php

/**
 * @package laragrad/identifier-validation
 * @desc Default configuration file
 */
return [
    'rules' => [

        // RUS
        'rus_inn'           => \Laragrad\IdentifierValidation\Rules\RUS\RusInn::class,
        'rus_person_inn'    => \Laragrad\IdentifierValidation\Rules\RUS\RusPersonInn::class,
        'rus_kpp'           => \Laragrad\IdentifierValidation\Rules\RUS\RusKpp::class,
        'rus_ogrn'          => \Laragrad\IdentifierValidation\Rules\RUS\RusOgrn::class,
        'rus_ogrnip'        => \Laragrad\IdentifierValidation\Rules\RUS\RusOgrnip::class,
        'rus_snils'         => \Laragrad\IdentifierValidation\Rules\RUS\RusSnils::class,

        // KAZ
        'kaz_iin'           => \Laragrad\IdentifierValidation\Rules\KAZ\KazIin::class,
        'kaz_bin'           => \Laragrad\IdentifierValidation\Rules\KAZ\KazBin::class,

        // BLR
        'blr_unp'           => \Laragrad\IdentifierValidation\Rules\BLR\BlrUnp::class,
        'blr_person_unp'    => \Laragrad\IdentifierValidation\Rules\BLR\BlrPersonUnp::class,

        // UKR
        'ukr_edrpou'        => \Laragrad\IdentifierValidation\Rules\UKR\UkrEdrpou::class,
        'ukr_rnokpp'        => \Laragrad\IdentifierValidation\Rules\UKR\UkrRnokpp::class,

        // Other
        'bank_card_number'  => \Laragrad\IdentifierValidation\Rules\BankCardNumber::class,
        'isin'              => \Laragrad\IdentifierValidation\Rules\Isin::class,
        'iban'              => \Laragrad\IdentifierValidation\Rules\Iban::class,
    ],
];