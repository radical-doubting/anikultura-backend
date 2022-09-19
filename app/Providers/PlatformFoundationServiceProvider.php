<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Orchid\Platform\Providers\FoundationServiceProvider as ServiceProvider;

class PlatformFoundationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (Config::get('anikultura.isHeadless')) {
            return;
        }

        parent::boot();
    }

    public function provides(): array
    {
        if (Config::get('anikultura.isHeadless')) {
            return [];
        } else {
            return parent::provides();
        }
    }
}
