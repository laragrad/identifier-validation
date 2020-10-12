# laragrad/identifier-validation

The package provides an extended set of rules for validating any national IDs of legal and individuals.

## Extended rules

* RUS - Russia
  * **rus_person_inn** - Idetification Number Of Tax Payer for individuals (ИНН)
  * **rus_inn** - Idetification Number Of Tax Payer for legals (ИНН)
  * **rus_kpp** - Code of the reason for registration (КПП)
  * **rus_ogrn** - Main state registration number of legal (ОГРН)
  * **rus_ogrnip** - Main state registration number of individual employer (ОГРНИП)
  * **rus_snils** - Insurance number of the individual personal account (СНИЛС)
* KAZ - Kazakhstan
  * **kaz_iin** - Individual Identification Number (ИИН)
  * **kaz_bin** - Business Identification Number (БИН)
* BLR - Belarus
  * **blr_unp** - Tax payer's account number for legals (УНП)
  * **blr_person_unp** - Tax payer's account number for individual (УНП)
* UKR - Ukraine
  * **ukr_edrpou** - (ЕДРПОУ)
* Any international codes
  * **bank_card_number** - Any bank card number
  * **isin** - International Securities Identification Number

## Installation

    composer require laragrad/identifier-validation
  
The service provider will be registering in app automaticaly.

## Configuring

Package must be configured with /config/laragrad/identifier-validation.php

You can publish default config file. For it run command

    php artisan vendor:publish --provider=Laragrad\IdentifierValidation\IdentifierValidationServiceProvider
    
You can comment out the rules that will not be used in your app.

## Adding custom rules

You can add own custom rule extension. 

Custom rule extension class must extends \Laragrad\IdentifierValidation\Rules\AbstractRuleExtension and realize your logic in extend() method.


