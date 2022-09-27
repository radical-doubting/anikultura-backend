<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static bool isHeadless()
 * @method static \App\Enums\InsightsMode getInsightsMode()
 */
class Anikultura extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'anikultura';
    }
}
