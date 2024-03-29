# CloudFront Package for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/meema/laravel-cloudfront.svg?style=flat-square)](https://packagist.org/packages/meema/laravel-cloudfront)
[![GitHub Workflow Status](https://github.com/meemalabs/laravel-cloudfront/actions/workflows/run-tests.yml/badge.svg?label=tests)](https://github.com/meemalabs/laravel-cloudfront)
[![StyleCI](https://github.styleci.io/repos/320476033/shield?branch=main)](https://github.styleci.io/repos/320476033)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/meemalabs/laravel-cloudfront/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/meemalabs/laravel-cloudfront/?branch=main)
[![Total Downloads](https://img.shields.io/packagist/dt/meema/laravel-cloudfront.svg?style=flat-square)](https://packagist.org/packages/meema/laravel-cloudfront)
[![Discord](https://img.shields.io/discord/834503516134441012?label=discord&dstyle=flat)](https://discord.meema.io)
[![License](https://img.shields.io/github/license/meemalabs/laravel-cloudfront.svg?style=flat-square)](https://github.com/meemalabs/laravel-cloudfront/blob/main/LICENSE.md)

This is a wrapper package for AWS CloudFront. Please note that while this package is used in production environments and is completely functional, it currently only focuses on cache invalidations.

PRs & ideas are more than welcome! 🙏🏼

![laravel-cloudfront package image](https://banners.beyondco.de/CloudFront.png?theme=light&packageManager=composer+require&packageName=meema%2Flaravel-cloudfront&pattern=endlessClouds&style=style_1&description=Easily+%26+quickly+integrate+your+application+with+AWS+CloudFront.&md=1&showWatermark=1&fontSize=150px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg)

## 💡 Usage

``` php
use Meema\CloudFront\Facades\CloudFront;
use Meema\CloudFront\Jobs\InvalidateCache;

// run any of the following CloudFront methods:
$client = CloudFront::getClient(); // exposes the AWS CloudFront client

$paths = ['/some-path.jpg', '/another/path.png'];
$result = CloudFront::invalidate($paths, string $distributionId = null);

// invalidates everything, which is the equivalent to a item path of `/*`.
$result = CloudFront::reset();

$message = CloudFront::getInvalidation(string $invalidationId, string $distributionId = null);
$messages = CloudFront::listInvalidations(string $distributionId = null);

// it's recommended to invalidate your cache using a job
dispatch(new InvalidateCache($path.'*')); // you may want to add a '*'-wildcard at the end of your path if you whitelisted any query parameters
```

Please note, object invalidations typically take from 60 to 300 seconds to complete. You can check the status of an invalidation by viewing your distribution from the [CloudFront console](https://console.aws.amazon.com/cloudfront/).

## 🐙 Installation

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
AWS_CLOUDFRONT_DISTRIBUTION_ID=xxxxxxx
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

    'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),

    /**
     * Specify the version of the CloudFront API you would like to use.
     * Please only adjust this value if you know what you are doing.
     */
    'version' => 'latest',

    /**
     * Specify the CloudFront Distribution ID.
     * Example format: EBCYQAQALNSKL
     */
    'distribution_id' => env('AWS_CLOUDFRONT_DISTRIBUTION_ID'),

];
```

## 🧪 Testing

``` bash
composer test
```

## 📈 Changelog

Please see our [releases](https://github.com/meemalabs/laravel-cloudfront/releases) page for more information on what has changed recently.

## 💪🏼 Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## 🏝 Community

For help, discussion about best practices, or any other conversation that would benefit from being searchable:

[Laravel CloudFront on GitHub](https://github.com/meemalabs/laravel-cloudfront/discussions)

For casual chit-chat with others using this package:

[Join the Meema Discord Server](https://discord.meema.io)

## 🚨 Security

Please review [our security policy](https://github.com/meemalabs/laravel-cloudfront/security/policy) on how to report security vulnerabilities.

## 🙏🏼 Credits

- [Chris Breuer](https://github.com/Chris1904)
- [Folks at Meema](https://github.com/meemalabs)
- [All Contributors](../../contributors)

## 📄 License

The MIT License (MIT). Please see [LICENSE](LICENSE.md) for more information.

Made with ❤️ by Meema, Inc.
