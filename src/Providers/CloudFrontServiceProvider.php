<?php

namespace Meema\CloudFront\Providers;

use Illuminate\Support\ServiceProvider;
use Meema\CloudFront\CloudFrontManager;
use Meema\CloudFront\Facades\CloudFront;

class CloudFrontServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/config.php' => config_path('cloudfront.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/config.php', 'cloudfront');

        $this->registerCloudFrontManager();

        $this->registerAliases();
    }

    /**
     * Registers the Text to speech manager.
     *
     * @return void
     */
    protected function registerCloudFrontManager()
    {
        $this->app->singleton('cloudfront', function ($app) {
            return new CloudFrontManager($app);
        });
    }

    /**
     * Register aliases.
     *
     * @return void
     */
    protected function registerAliases()
    {
        $this->app->alias(CloudFront::class, 'CloudFront');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [
            'cloudfront',
        ];
    }
}
