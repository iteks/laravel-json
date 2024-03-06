<?php

use Iteks\Support\Facades\Json;
use Iteks\Support\JsonServiceProvider;
use Iteks\Support\Services\JsonService;

describe('Service Provider', function () {
    it('registers the json service on the container', function () {
        $app = app();

        (new JsonServiceProvider($app))->register();

        expect($app->get(Json::class))->toBeInstanceOf(Json::class);
    });

    it('registers the json service on the container as singleton', function () {
        $app = app();

        (new JsonServiceProvider($app))->register();

        $enum = $app->get(Json::class);

        expect($enum)->toBeInstanceOf(Json::class);
    });

    it('provides', function () {
        $app = app();

        $provides = (new JsonServiceProvider($app))->provides();

        expect($provides)->toBe([
            'json',
            JsonService::class,
        ]);
    });
})->group('service-provider');
