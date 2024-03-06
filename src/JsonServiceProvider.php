<?php

declare(strict_types=1);

namespace Iteks\Support;

use Illuminate\Support\ServiceProvider;
use Iteks\Support\Services\JsonService;

class JsonServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('json', function () {
            return new JsonService();
        });
    }

    public function provides(): array
    {
        return [
            'json',
            JsonService::class,
        ];
    }
}
