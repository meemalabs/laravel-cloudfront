<?php

namespace Meema\CloudFront\Tests;

use Meema\CloudFront\Providers\CloudFrontServiceProvider;
use Orchestra\Testbench\TestCase;

class CloudFrontTestCase extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [CloudFrontServiceProvider::class];
    }
}
