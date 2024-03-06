<?php

declare(strict_types=1);

use Illuminate\Filesystem\FilesystemServiceProvider;
use Illuminate\Foundation\Application;
use Iteks\Support\JsonServiceProvider;

uses()->beforeEach(function () {
    // Create a fresh copy of the application for each test.
    $app = Application::getInstance();

    // Manually register the FilesystemServiceProvider.
    $app->register(FilesystemServiceProvider::class);

    // Manually register the package's service provider.
    $app->register(JsonServiceProvider::class);

    // Boot the application.
    $app->boot();
})->in('Facades');
