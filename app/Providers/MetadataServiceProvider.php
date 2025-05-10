<?php

use App\Services\MetadataService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class MetadataServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->singleton(MetadataService::class, fn ($app) => new MetadataService(
            request: $app['request'],
            config: $app['config']->get('metadata', [])
        ));
    }

    public function provides(): array
    {
        return [MetadataService::class];
    }
}