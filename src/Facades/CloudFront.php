<?php

namespace Meema\CloudFront\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Aws\Result invalidateCache(string $id)
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
