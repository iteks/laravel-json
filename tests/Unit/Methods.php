<?php

declare(strict_types=1);

use Illuminate\Support\Collection;
use Iteks\Support\Facades\Json;
use Iteks\Support\JsonServiceProvider;
use Iteks\Support\Traits\DefinesJsonColumns;

describe('Methods', function () {
    it('can convert JSON file to a collection of collections', function () {
        $app = app();

        (new JsonServiceProvider($app))->register();

        Json::setFacadeApplication($app);

        // Path to the example.json file.
        $path = __DIR__ . '/../../data/example.json';

        $collection = Json::toCollection($path);

        expect($collection->first())->toBeInstanceOf(Collection::class);
        expect($collection->first()->get('border'))->toEqual('3px solid white');
    });

    it('can convert JSON file to an associative array with specified attribute', function () {
        $app = app();

        (new JsonServiceProvider($app))->register();

        Json::setFacadeApplication($app);

        // Path to the example.json file.
        $path = __DIR__ . '/../../data/example.json';

        $array = Json::toArray($path, 'border');

        expect($array)->toBeArray();
        expect($array)->toHaveCount(3);
        expect($array[0])->toEqual('3px solid white');
    });

    it('can enforce JSON definition correctly', function () {
        $model = new class
        {
            use DefinesJsonColumns;

            protected $jsonDefinitions = [
                'profile' => [
                    'age' => 'integer',
                    'name' => 'string',
                ],
            ];
        };

        $json = json_encode([
            'name' => 'Jeramy Hing',
            'age' => '32',
            'email' => 'jeramy@example.com',
        ]);

        $expected = json_encode([
            'name' => 'Jeramy Hing',
            'age' => 32,
        ]);

        $modelClass = get_class($model);

        $result = Json::enforceDefinition($modelClass, 'profile', $json);

        expect($result)->toBeJson();
        expect(json_decode($result, true))->toMatchArray(json_decode($expected, true));
    });

    it('can enforce JSON definition with missing keys', function () {
        $model = new class
        {
            use DefinesJsonColumns;

            protected $jsonDefinitions = [
                'profile' => [
                    'age' => 'integer',
                    'name' => 'string',
                ],
            ];
        };

        $json = json_encode([
            'name' => 'Jeramy Hing',
        ]);

        $expected = json_encode([
            'name' => 'Jeramy Hing',
            'age' => null,
        ]);

        $modelClass = get_class($model);

        $result = Json::enforceDefinition($modelClass, 'profile', $json);

        expect($result)->toBeJson();
        expect(json_decode($result, true))->toMatchArray(json_decode($expected, true));
    });
})->group('json');
