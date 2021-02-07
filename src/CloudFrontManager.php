<?php

namespace Meema\CloudFront;

use Aws\CloudFront\CloudFrontClient;
use Aws\Credentials\Credentials;
use Exception;
use Illuminate\Support\Manager;

class CloudFrontManager extends Manager
{
    /**
     * Get a driver instance.
     *
     * @param string|null $name
     * @return mixed
     */
    public function engine($name = null)
    {
        return $this->driver($name);
    }

    /**
     * Create an Amazon CloudFront instance.
     *
     * @return \Meema\CloudFront\CloudFront
     * @throws \Exception
     */
    public function createCloudFrontDriver(): CloudFront
    {
        $this->ensureAwsSdkIsInstalled();

        $config = $this->config['cloudfront'];

        $credentials = $this->getCredentials($config['credentials']);

        $client = $this->setCloudFrontClient($config, $credentials);

        return new CloudFront($client);
    }

    /**
     * Sets the polly client.
     *
     * @param array $config
     * @param Credentials $credentials
     * @return \Aws\CloudFront\CloudFrontClient
     */
    protected function setCloudFrontClient(array $config, Credentials $credentials): CloudFrontClient
    {
        return new CloudFrontClient([
            'version' => $config['version'],
            'region' => $config['region'],
            'credentials' => $credentials,
        ]);
    }

    /**
     * Get credentials of AWS.
     *
     * @param array $credentials
     * @return \Aws\Credentials\Credentials
     */
    protected function getCredentials(array $credentials): Credentials
    {
        return new Credentials($credentials['key'], $credentials['secret']);
    }

    /**
     * Ensure the AWS SDK is installed.
     *
     * @return void
     *
     * @throws \Exception
     */
    protected function ensureAwsSdkIsInstalled()
    {
        if (! class_exists(CloudFrontClient::class)) {
            throw new Exception('Please install the AWS SDK PHP using `composer require aws/aws-sdk-php`.');
        }
    }

    /**
     * Get the default Text to Speech driver name.
     *
     * @return string
     */
    public function getDefaultDriver(): string
    {
        return 'cloudfront';
    }
}
