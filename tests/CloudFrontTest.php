<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Meema\CloudFront\Facades\CloudFront;

uses(Meema\CloudFront\Tests\CloudFrontTestCase::class);

beforeEach(function () {
    $this->initializeDotEnv();
    $this->initializeSettings();
});

it('can fetch cloudfront client', function () {
    $client = CloudFront::getClient();

    $this->assertTrue(! is_null($client));
});

it('can invalidate image', function () {
    $domainDevCdn = config('cloudfront.distribution_url');

    $path = '/glenn/1/3/people.jpg';

    $urlDevCdn = "{$domainDevCdn}{$path}";

    Http::get($urlDevCdn)->body();

    $finalPath = '/glenn/1/3/people.jp*';

    $response = CloudFront::invalidate($finalPath, config('cloudfront.distribution_id'));

    $this->assertEquals($response['@metadata']['statusCode'], 201);
});

it('can invalidate everything', function () {
    $domainDevCdn = config('cloudfront.distribution_url');

    $path = '/glenn/1/3/people.jpg';

    $urlDevCdn = "{$domainDevCdn}{$path}";

    Http::get($urlDevCdn)->body();

    $response = CloudFront::reset();

    $this->assertEquals($response['@metadata']['statusCode'], 201);
});

it('can get invalidation string', function () {
    $domainDevCdn = config('cloudfront.distribution_url');

    $path = '/glenn/1/3/people.jpg';

    $urlDevCdn = "{$domainDevCdn}{$path}";

    Http::get($urlDevCdn)->body();

    $finalPath = '/glenn/1/3/people.jp*';

    $result = CloudFront::invalidate($finalPath, config('cloudfront.distribution_id'));

    $response = CloudFront::getInvalidation($result['Invalidation']['Id']);

    $status = Str::contains($response, "The status for the invalidation with the ID of {$result['Invalidation']['Id']} is InProgress");

    $this->assertTrue($status);
});

it('can list invalidations processes', function () {
    $response = CloudFront::listInvalidations(config('cloudfront.distribution_id'));

    $this->assertTrue(is_array($response));
    $this->assertTrue(count($response) > 0);
});
