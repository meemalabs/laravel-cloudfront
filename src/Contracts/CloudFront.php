<?php

namespace Meema\CloudFront\Contracts;

interface CloudFront
{
    /**
     * Delete items in your CloudFront cache .
     *
     * @param array|string $items
     * @param string|null $distributionId
     * @return \Aws\Result
     */
    public function invalidate($items, string $distributionId = null);

    /**
     * Delete everything in your CloudFront cache .
     *
     * @param string|null $distributionId
     * @return \Aws\Result
     */
    public function reset(string $distributionId = null);

    /**
     * Delete items in your CloudFront cache .
     *
     * @param string $invalidationId
     * @param string|null $distributionId
     * @return \Aws\Result
     */
    public function getInvalidation(string $invalidationId, string $distributionId = null);

    /**
     * Delete items in your CloudFront cache .
     *
     * @param string|null $distributionId
     * @return \Aws\Result
     */
    public function listInvalidations(string $distributionId = null);
}
