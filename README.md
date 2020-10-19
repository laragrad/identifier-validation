# laragrad/identifier-validation

The package provides an extended set of rules for validating any national IDs of legal and individuals.

## List of rules

* **BLR** - Belarus
    * **blr_unp** - Tax payer's account number for legals (УНП)
    * **blr_person_unp** - Tax payer's account number for individual (УНП)
* **KAZ** - Kazakhstan
    * **kaz_iin** - Individual Identification Number (ИИН)
    * **kaz_bin** - Business Identification Number (БИН)
* **RUS** - Russia
    * **rus_person_inn** - Idetification Number Of Tax Payer for individuals (ИНН)
    * **rus_inn** - Idetification Number Of Tax Payer for legals (ИНН)
    * **rus_kpp** - Code of the reason for registration (КПП)
    * **rus_ogrn** - Main state registration number of legal (ОГРН)
    * **rus_ogrnip** - Main state registration number of individual employer (ОГРНИП)
    * **rus_snils** - Insurance number of the individual personal account (СНИЛС)
* **UKR** - Ukraine
    * **ukr_edrpou** - (ЕДРПОУ)
* Any international codes
    * **bank_card_number** - Any bank card number
    * **isin** - International Securities Identification Number
    * **iban** - International Bank Account Number (ISO-13616)

## Installation

To install the package run command

    composer require laragrad/identifier-validation
  
The service provider will be registering in app automaticaly.

## Configuring

Package has a default configuration but you can publish configuration file to your project. Run command

    php artisan vendor:publish --provider=Laragrad\IdentifierValidation\IdentifierValidationServiceProvider
    
Configuration file published to `config/laragrad/identifier-validation.php`. You can comment out any rules that will not be used in your app.

## Adding custom rules

You can add own custom rule extension. 

Custom rule extension class must extends `\Laragrad\IdentifierValidation\Rules\AbstractRuleExtension` and realize your logic in `extend()` method.
