<?php

namespace App\Traits;

use App\Observers\LoggingObserver;

trait Loggable
{
    public static function bootLoggable(): void
    {
        static::observe(new LoggingObserver());
    }
}
