<?php

describe('Arch', function () {
    test('facades')
        ->expect('Iteks\Support\Facades\Json')
        ->toOnlyUse([
            'Illuminate\Support\Facades\Facade',
            'Iteks\Support\Services\JsonService',
        ]);

    test('service providers')
        ->expect('Iteks\Support\JsonServiceProvider')
        ->toOnlyUse([
            'Illuminate\Support\ServiceProvider',
            'Iteks\Support\Facades\Json',
            'Iteks\Support\Services\JsonService',
        ]);
})->group('arch');
