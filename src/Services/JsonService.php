<?php

declare(strict_types=1);

namespace Iteks\Support\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class JsonService
{
    /**
     * Create a nested Collection from the given JSON file containing an array of objects.
     *
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
     * @return array<int|string, mixed> The array with mixed types for both keys and values.
     */
    public static function toArray(string $path, ?string $attribute = null): array
    {
        return static::toCollection($path, $attribute)->toArray();
    }
}
