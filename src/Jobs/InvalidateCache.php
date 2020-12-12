<?php

namespace Meema\CloudFront\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Meema\CloudFront\Facades\CloudFront;

class InvalidateCache implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $paths;

    /**
     * Create a new job instance.
     *
     * @param string|array $paths
     */
    public function __construct($paths)
    {
        $this->paths = $paths;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        CloudFront::invalidate($this->paths);
    }
}
