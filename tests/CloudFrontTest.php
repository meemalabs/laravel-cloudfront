<?php

namespace Meema\CloudFront\Tests;

use Aws\CloudFront\CloudFrontClient;

class CloudFrontTest extends CloudFrontTestCase
{
    /**
     * @var \Aws\CloudFront\CloudFrontClient
     */
    protected $client;

    /**
     * Setup client and results.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->client = $this->getMockBuilder(CloudFrontClient::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /** @test */
    public function it_can_bust_a_cache_item()
    {
        $this->markTestIncomplete();
    }
}
