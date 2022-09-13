# laragrad/identifier-validation

The package provides an extended set of rules for validating any national IDs of legal and individuals.

## List of rules

* **BLR** - Belarus
    * **blr_unp** - Tax payer's account number for legals (ru: УНП)
    * **blr_person_unp** - Tax payer's account number for individual (ru: УНП)
* **KAZ** - Kazakhstan
    * **kaz_iin** - Individual Identification Number (IIN, ru: ИИН) for Kazakhstan
    * **kaz_bin** - Business Identification Number (BIN, ru: БИН) for Kazakhstan
* **RUS** - Russia
    * **rus_person_inn** - Tax payer Idetification Number for individuals (TIN, ru: ИНН)
    * **rus_inn** - Tax payer Idetification Number for legals (TIN, ru: ИНН)
    * **rus_kpp** - Code of the Reason for Registration (ru: КПП)
    * **rus_ogrn** - Primary State Registration Number of legal (ru: ОГРН)
    * **rus_ogrnip** - Primary State Registration Number of individual employer (ru: ОГРНИП)
    * **rus_snils** - Insurance Number of the Individual Personal Account (ru: СНИЛС)
* **UKR** - Ukraine
    * **ukr_edrpou** - (uk: ЄДРПОУ, ru: ЕГРПОУ)
    * **ukr_rnokpp** - (uk: РНОКПП)
* **FRA** - France
    * **fra_siren** - (fr: SIREN)
    * **fra_siret** - (fr: SIRET)
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
