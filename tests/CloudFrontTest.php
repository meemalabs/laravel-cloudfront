<?php

// namespace Meema\CloudFront\Tests;

// use Aws\CloudFront\CloudFrontClient;

// class CloudFrontTest extends CloudFrontTestCase
// {
//     /**
//      * @var \Aws\CloudFront\CloudFrontClient
//      */
//     protected $client;

//     /**
//      * Setup client and results.
//      *
//      * @return void
//      */
//     public function setUp(): void
//     {
//         parent::setUp();

//         $this->client = $this->getMockBuilder(CloudFrontClient::class)
//             ->disableOriginalConstructor()
//             ->getMock();
//     }

//     /** @test */
//     public function it_can_bust_a_cache_item()
//     {
//         $this->markTestIncomplete();
//     }
// }

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
    $paths = '/glenn/1/2/butterfly.jpg';

    CloudFront::invalidate($paths, config('cloudfront.distribution_ops_id'));
});
