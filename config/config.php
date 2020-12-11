<?php

return [
    /**
     * IAM Credentials from AWS.
     */
    'credentials' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
    ],

    'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),

    /**
     * Specify the version of the CloudFront API you would like to use.
     * Please only adjust this value if you know what you are doing.
     */
    'version' => 'latest',

    /**
     * Specify the CloudFront Distribution ID.
     * Example format: EBCYQAQALNSKL.
     */
    'distribution_id' => env('AWS_CLOUDFRONT_DISTRIBUTION_ID'),

];
