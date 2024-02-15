<?php

declare(strict_types=1);

namespace Iteks\Support\Facades;

use Illuminate\Support\Facades\Facade;

class Json extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor()
    {
        return 'json';
    }
}
