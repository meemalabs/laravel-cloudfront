<?php

namespace Meema\CloudFront\Contracts;

interface CloudFront
{
    /**
     * Delete items in your CloudFront cache .
     *
     * @param array $items
     * @param int $quantity
     * @param string|null $distributionId
     * @return \Aws\Result
     */
    public function invalidate(array $items, int $quantity = 1, string $distributionId = null);

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
