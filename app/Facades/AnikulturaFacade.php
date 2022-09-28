<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static bool isHeadless()
 * @method static bool isInsightsEnabled()
 * @method static \App\Enums\InsightsMode getInsightsMode()
 */
class AnikulturaFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'anikultura';
    }
}
