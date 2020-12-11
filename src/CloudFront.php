<?php

namespace Meema\CloudFront;

use Aws\CloudFront\CloudFrontClient;
use Aws\Credentials\Credentials;
use Aws\Exception\AwsException;
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

        $this->client = new $client([
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
     * Bust an item/s in CloudFront's cache.
     *
     * @param array|string $items
     * @param string|null $distributionId
     * @return \Aws\Result
     */
    public function invalidate($items, string $distributionId = null)
    {
        if (is_string($items)) {
            $arr[] = $items;
            $items = $arr;
        }

        return $this->client->createInvalidation([
            'DistributionId' => $distributionId ?? config('cloudfront.distribution_id'),
            'InvalidationBatch' => [
                // CallerReference is a unique value that you provide and that CloudFront uses to prevent replays of your request.
                // You must provide a new caller reference value and other new information in the request for CloudFront to create a new invalidation request.
                'CallerReference' => microtime(true),
                'Paths' => [
                    'Items' => $items,
                    'Quantity' => count($items),
                ],
            ],
        ]);
    }

    /**
     * Remove every item out of your CloudFront distribution.
     *
     * @param string|null $distributionId
     * @return \Aws\Result
     */
    public function reset(string $distributionId = null)
    {
        return $this->invalidate('/*', $distributionId ?? config('cloudfront.distribution_id'));
    }

    /**
     * Get a cache "invalidation".
     *
     * @param string $invalidationId
     * @param string|null $distributionId
     * @return string
     */
    public function getInvalidation(string $invalidationId, string $distributionId = null)
    {
        try {
            $result = $this->client->getInvalidation([
                'DistributionId' => $distributionId ?? config('cloudfront.distribution_id'),
                'Id' => $invalidationId,
            ]);

            $message = '';

            if (isset($result['Invalidation']['Status'])) {
                $message = 'The status for the invalidation with the ID of '.$result['Invalidation']['Id'].' is '.$result['Invalidation']['Status'];
            }

            if (isset($result['@metadata']['effectiveUri'])) {
                $message .= ', and the effective URI is '.$result['@metadata']['effectiveUri'].'.';
            } else {
                $message = 'Error: Could not get information about '.'the invalidation. The invalidation\'s status '.'was not available.';
            }

            return $message;
        } catch (AwsException $e) {
            throw($e->getAwsErrorMessage());
        }
    }

    /**
     * List all of the cache invalidations.
     *
     * @param string|null $distributionId
     * @return array
     */
    public function listInvalidations(string $distributionId = null)
    {
        try {
            $invalidations = $this->client->listInvalidations([
                'DistributionId' => $distributionId ?? config('cloudfront.distribution_id'),
            ]);

            $messages = [];

            if (isset($invalidations['InvalidationList'])) {
                if ($invalidations['InvalidationList']['Quantity'] > 0) {
                    foreach ($invalidations['InvalidationList']['Items'] as $invalidation) {
                        $message = 'The invalidation with the ID of '.$invalidation['Id'].' has the status of '.$invalidation['Status'].'.';
                        $messages[$invalidation['Id']] = $message;
                    }
                } else {
                    $message = 'Could not find any invalidations for the specified distribution.';
                    array_push($messages, $message);
                }
            } else {
                $message = 'Error: Could not get invalidation information. Could not get information about the specified distribution.';
                array_push($messages, $message);
            }

            return $messages;
        } catch (AwsException $e) {
            throw($e->getAwsErrorMessage());
        }
    }
}
