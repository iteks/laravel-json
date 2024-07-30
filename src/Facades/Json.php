<?php

declare(strict_types=1);

namespace Iteks\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Support\Collection toCollection(string $path, ?string $attribute = null) Create a nested Collection from the given JSON file containing an array of objects.
 * @method static array toArray(string $path, ?string $attribute = null) Create a nested associative array from the given JSON file containing an array of objects.
 * @method static string enforceDefinition(string $model, string $column, ?string $json) Enforce JSON definition for a specified model and column, by ensuring all defined keys exist and stripping out undefined keys.
 */
class Json extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'json';
    }
}
