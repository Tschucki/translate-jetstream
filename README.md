# Translate your Jetstream Inertia Templates Using Regex

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tschucki/translate-jetstream.svg?style=flat-square)](https://packagist.org/packages/tschucki/translate-jetstream)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/tschucki/translate-jetstream/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/tschucki/translate-jetstream/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/tschucki/translate-jetstream/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/tschucki/translate-jetstream/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/tschucki/translate-jetstream.svg?style=flat-square)](https://packagist.org/packages/tschucki/translate-jetstream)

![Marcel Wagner Translate Jetstream](https://preview.dragon-code.pro/Marcel%20Wagner/Translate%20Jetstream.svg?brand=laravel&mode=auto)

Translate Jetstream's Vue templates into any language you want. Without much effort.

It annoyed me that Jetstream's Vue templates are not translated. Sometimes I need Jetstream in a language other than English and I didn't want to translate everything by hand.

## Installation

You can install the package via composer:

```bash
composer require --dev tschucki/translate-jetstream
```

I recommend to only use this package in a local development environment and a fresh installation of Jetstream.

You better commit your changes before running the command, so you can easily revert them if something feels wrong.

## Usage

### Basic Usage

Call the following command to select the language you want to translate Jetstream into:

```bash
php artisan jetstream:translate
```

You will be asked for the language you want to translate Jetstream into. The default language is your locale set in your Laravel application.

### Locale as Argument

You can also pass the locale as an argument:

```bash
php artisan jetstream:translate de
```

## Demo

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Marcel Wagner](https://github.com/Tschucki)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
