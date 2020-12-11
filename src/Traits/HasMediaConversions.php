<?php

namespace Meema\CloudFront\Traits;

use Meema\CloudFront\Models\MediaConversion;

trait HasMediaConversions
{
    /**
     * Get all of the media items' conversions.
     */
    public function conversions()
    {
        return $this->morphMany(MediaConversion::class, 'model');
    }
}
