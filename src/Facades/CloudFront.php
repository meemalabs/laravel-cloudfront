<?php

namespace Meema\CloudFront\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Aws\CloudFront\CloudFrontClient getClient()
 * @method static \Aws\Result invalidate(array|string $paths, string $distributionId = null)
 * @method static \Aws\Result reset(string $distributionId = null)
 * @method static string getInvalidation(string $invalidationId, string $distributionId = null)
 * @method static array listInvalidations(string $distributionId = null)
 */
class CloudFront extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'cloudfront';
    }
}
