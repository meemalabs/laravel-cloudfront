<?php

namespace Meema\CloudFront\Contracts;

interface CloudFront
{
    /**
     * Cancels an active job.
     *
     * @param string $id
     * @return \Aws\Result
     */
    public function createInvalidation(string $id);
}
