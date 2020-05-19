# Laravel Exists Without Soft Deleted Validation Rule

Most of my applications use models with the `SoftDeletes` trait.

Therefore on all my validation rules I always have to specify the `whereNull` additional statement to an `exists` validation rule.

This package provide a shortcut `exists_without_soft_deleted` rule for it.

## Table of Contents

* [Installation](#installation)
* [Usage](#usage)
    * [Validation Rule](#validation-rule)
* [License](#license)
* [Security Vulnerabilities](#security-vulnerabilities)

## Installation

``` bash
composer require thtg88/laravel-exists-without-soft-deleted-rule
```

You can publish the configuration file and views by running:
```bash
php artisan vendor:publish --provider="Thtg88\LaravelExistsWithoutSoftDeletedRule\LaravelExistsWithoutSoftDeletedRuleServiceProvider"
```

## Usage

Laravel Exists Without Soft Deleted Validation Rule exposes a validation rule to check existence of a model, without soft-deleted ones.

### Validation Rule

The validation rule is available using `exists_without_soft_deleted`.

## License

Laravel Exists Without Soft Deleted Validation Rule is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel Exists Without Soft Deleted Validation Rule, please send an e-mail to Marco Marassi at security@marco-marassi.com. All security vulnerabilities will be promptly addressed.
