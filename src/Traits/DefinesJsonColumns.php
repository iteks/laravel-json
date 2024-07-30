<?php

declare(strict_types=1);

namespace Iteks\Support\Traits;

trait DefinesJsonColumns
{
    /**
     * Get the JSON definition for a given attribute.
     *
     * @param  string  $attribute
     * @return array|null
     */
    public function getColumnDefinition(string $attribute): ?array
    {
        return $this->jsonDefinitions[$attribute] ?? null;
    }
}
