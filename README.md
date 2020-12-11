# CloudFront Package for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/meema/laravel-cloudfront.svg?style=flat-square)](https://packagist.org/packages/meema/laravel-cloudfront)
[![StyleCI](https://github.styleci.io/repos/264578171/shield?branch=master)](https://github.styleci.io/repos/264578171)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/meemaio/laravel-cloudfront/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/meemaio/laravel-cloudfront/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/meema/laravel-cloudfront.svg?style=flat-square)](https://packagist.org/packages/meema/laravel-cloudfront)
[![License](https://img.shields.io/github/license/meemaio/laravel-cloudfront.svg?style=flat-square)](https://github.com/meemaio/laravel-cloudfront/blob/master/LICENSE.md)
<!-- [[![Test](https://github.com/meemaio/laravel-cloudfront/workflows/Test/badge.svg?branch=master)](https://github.com/meemaio/laravel-cloudfront/actions) -->
<!-- [[![Build Status](wip)](ghactions) -->

This is a wrapper package for AWS CloudFront.

![laravel-cloudfront package image](https://banners.beyondco.de/CloundFront.png?theme=light&packageManager=composer+require&packageName=meema%2Flaravel-cloudfront&pattern=endlessClouds&style=style_1&description=Easily+%26+quickly+integrate+your+application+with+AWS+CloudFront.&md=1&showWatermark=1&fontSize=150px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg)

## Usage

``` php
use Meema\CloudFront\Facades\CloudFront;

// run any of the following CloudFront methods:
$result = CloudFront::invalidateCache(string $id);
```

## Installation

You can install the package via composer:

```bash
composer require meema/laravel-cloudfront
```

The package will automatically register itself.

Next, publish the config file with:

```bash
php artisan vendor:publish --provider="Meema\CloudFront\Providers\CloudFrontServiceProvider" --tag="config"
```

Next, please add the following keys their values to your `.env` file.

```bash
AWS_ACCESS_KEY_ID=xxxxxxx
AWS_SECRET_ACCESS_KEY=xxxxxxx
```

The following is the content of the published config file:

```php
return [
    /**
     * IAM Credentials from AWS.
     */
    'credentials' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
    ],

    'version' => 'latest',

];
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email chris@cion.agency instead of using the issue tracker.

## Credits

- [Chris Breuer](https://github.com/Chris1904)
- [Folks at Meema](https://github.com/meemaio)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

Made with ❤️ by Meema, Inc.
