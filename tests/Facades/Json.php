<?php

declare(strict_types=1);

use Iteks\Support\Facades\Json;
use Iteks\Support\JsonServiceProvider;

describe('Facade', function () {
    it('resolves facades', function () {
        $app = app();

        (new JsonServiceProvider($app))->register();

        Json::setFacadeApplication($app);

        // Path to the example.json file.
        $path = __DIR__ . '/../../data/example.json';

        $array = Json::toArray($path);

        expect($array)->toBeArray();
    });
})->group('facade');
