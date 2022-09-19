<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static bool isHeadless()
 */
class Anikultura extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'anikultura';
    }
}
