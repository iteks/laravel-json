<?php

declare(strict_types=1);

namespace Iteks\Support;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Iteks\Support\Services\JsonService;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->singleton('json', function () {
            return new JsonService();
        });
    }
}
