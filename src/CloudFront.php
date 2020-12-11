<?php

namespace Meema\CloudFront;

use Aws\Credentials\Credentials;
use Aws\CloudFront\CloudFrontClient;
use Meema\CloudFront\Contracts\CloudFront as CloudFrontInterface;

class CloudFront implements CloudFrontInterface
{
    /**
     * Client instance of CloudFront.
     *
     * @var \Aws\CloudFront\CloudFrontClient
     */
    protected CloudFrontClient $client;

    /**
     * Construct converter.
     *
     * @param \Aws\CloudFront\CloudFrontClient $client
     */
    public function __construct(CloudFrontClient $client)
    {
        $config = config('cloudfront');

        $this->client = new CloudFrontClient([
            'version' => $config['version'],
            'region' => $config['region'],
            'credentials' => new Credentials($config['credentials']['key'], $config['credentials']['secret']),
        ]);
    }

    /**
     * Get the CloudFront Client.
     *
     * @return \Aws\CloudFront\CloudFrontClient
     */
    public function getClient(): CloudFrontClient
    {
        return $this->client;
    }

    /**
     * Bust an item in CloudFront's cache.
     *
     * @param string $id
     * @return \Aws\Result
     */
    public function invalidateCache(string $id)
    {
        return $this->client->createInvalidation([
            'Id' => $id,
        ]);
    }
}
