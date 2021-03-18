<?php

namespace Meema\CloudFront\Tests;

use Dotenv\Dotenv;
use Illuminate\Support\Facades\Config;
use Meema\CloudFront\Providers\CloudFrontServiceProvider;
use Orchestra\Testbench\TestCase;

class CloudFrontTestCase extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [CloudFrontServiceProvider::class];
    }
    public function initializeDotEnv()
    {
        if (! file_exists(__DIR__.'/../.env')) {
            return;
        }

        $dotenv = Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->load();
    }

    public function initializeSettings()
    {
        // let's make sure these config values are set
        Config::set('cloudfront.credentials.key', env('AWS_ACCESS_KEY_ID'));
        Config::set('cloudfront.credentials.secret', env('AWS_SECRET_ACCESS_KEY'));
        Config::set('cloudfront.disk', env('REKOGNITION_DISK', 's3'));
        Config::set('cloudfront.distribution_id', env('AWS_CLOUDFRONT_DISTRIBUTION_ID'));
        Config::set('cloudfront.ops_distribution_id', env('AWS_CLOUDFRONT_OPS_DISTRIBUTION_ID'));
        Config::set('cloudfront.distribution_url', env('AWS_CLOUDFRONT_URL'));
        Config::set('cloudfront.ops_distribution_url', env('AWS_CLOUDFRONT_OPS_URL'));
        Config::set('filesystems.disks.s3.bucket', env('AWS_S3_BUCKET'));
    }
}
