<?php

declare(strict_types=1);

namespace Iteks\Support\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use InvalidArgumentException;

class JsonService
{
    /**
     * Create a nested Collection from the given JSON file containing an array of objects.
     *
     * @param  string  $path  The path to the JSON file.
     * @param  string|null  $attribute  The attribute to use as the array keys.
     * @return Collection<int|string, mixed> The collection with mixed types for both keys and values.
     */
    public static function toCollection(string $path, ?string $attribute = null): Collection
    {
        $json = json_decode(File::get($path), true);

        if (! is_array($json)) {
            return collect();
        }

        $data = collect($json)->mapInto(Collection::class);

        if ($attribute) {
            return $data->map(fn ($item) => $item->get($attribute));
        }

        return $data;
    }

    /**
     * Create a nested associative array from the given JSON file containing an array of objects.
     *
     * @param  string  $path  The path to the JSON file.
     * @param  string|null  $attribute  The attribute to use as the array keys.
     * @return array<int|string, mixed> The array with mixed types for both keys and values.
     */
    public static function toArray(string $path, ?string $attribute = null): array
    {
        return static::toCollection($path, $attribute)->toArray();
    }

    /**
     * Enforce JSON definition for a specified model and column,
     * by ensuring all defined keys exist and stripping out undefined keys.
     *
     * @param  string  $model  The model class name.
     * @param  string  $column  The column name.
     * @param  string|null  $json  The input JSON payload.
     * @return string The enforced JSON definition as a JSON string.
     */
    public static function enforceDefinition(string $model, string $column, ?string $json): string
    {
        $definition = self::getColumnDefinition($model, $column);

        $data = $json ? json_decode($json, true) : [];

        // Ensure all defined keys exist, strip out undefined keys, and enforce value types
        $result = [];
        foreach ($definition as $key => $type) {
            $value = $data[$key] ?? null;
            if (! is_null($value)) {
                self::setType($value, $type);
            }
            $result[$key] = $value;
        }

        return json_encode($result, JSON_UNESCAPED_UNICODE) ?: '';
    }

    /**
     * Get the JSON column definition from the model.
     *
     * @param  string  $model  The model class name.
     * @param  string  $column  The column name.
     * @return array The JSON column definition.
     */
    protected static function getColumnDefinition(string $model, string $column): array
    {
        $modelInstance = new $model;
        if (method_exists($modelInstance, 'getColumnDefinition')) {
            return $modelInstance->getColumnDefinition($column) ?? [];
        }

        throw new InvalidArgumentException("Model class $model does not have a getColumnDefinition method.");
    }

    /**
     * Set the type of a value according to the provided type.
     *
     * @param  mixed  $value  The value to typecast.
     * @param  string  $type  The type to cast to.
     * @return void
     */
    protected static function setType(&$value, string $type): void
    {
        switch ($type) {
            case 'string':
                $value = (string) $value;
                break;
            case 'int':
            case 'integer':
                $value = (int) $value;
                break;
            case 'bool':
            case 'boolean':
                $value = (bool) $value;
                break;
            case 'array':
                $value = (array) $value;
                break;
            case 'object':
                $value = (object) $value;
                break;
            case 'null':
                $value = null;
                break;
            default:
                throw new InvalidArgumentException("Unsupported type: $type");
        }
    }
}
