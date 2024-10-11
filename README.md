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

https://github.com/user-attachments/assets/f35bef80-b922-4d67-80da-9586fcf2456d

## Supported Languages

- "af"
- "ak"
- "am"
- "ar"
- "as"
- "az"
- "be"
- "bg"
- "bho"
- "bm"
- "bn"
- "bs"
- "ca"
- "ceb"
- "ckb"
- "cs"
- "cy"
- "da"
- "de"
- "de_CH"
- "doi"
- "ee"
- "el"
- "en"
- "eo"
- "es"
- "et"
- "eu"
- "fa"
- "fi"
- "fil"
- "fr"
- "fy"
- "ga"
- "gd"
- "gl"
- "gu"
- "ha"
- "haw"
- "he"
- "hi"
- "hr"
- "hu"
- "hy"
- "id"
- "ig"
- "is"
- "it"
- "ja"
- "ka"
- "kk"
- "km"
- "kn"
- "ko"
- "ku"
- "ky"
- "lb"
- "lg"
- "ln"
- "lo"
- "lt"
- "lv"
- "mai"
- "mg"
- "mi"
- "mk"
- "ml"
- "mn"
- "mni_Mtei"
- "mr"
- "ms"
- "mt"
- "my"
- "nb"
- "ne"
- "nl"
- "nn"
- "oc"
- "om"
- "or"
- "pa"
- "pl"
- "ps"
- "pt"
- "pt_BR"
- "qu"
- "ro"
- "ru"
- "rw"
- "sa"
- "sc"
- "sd"
- "si"
- "sk"
- "sl"
- "sn"
- "so"
- "sq"
- "sr_Cyrl"
- "sr_Latn"
- "sr_Latn_ME"
- "su"
- "sv"
- "sw"
- "ta"
- "te"
- "tg"
- "th"
- "ti"
- "tk"
- "tl"
- "tr"
- "tt"
- "ug"
- "uk"
- "ur"
- "uz_Cyrl"
- "uz_Latn"
- "vi"
- "xh"
- "yi"
- "yo"
- "zh_CN"
- "zh_HK"
- "zh_TW"
- "zu"

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
