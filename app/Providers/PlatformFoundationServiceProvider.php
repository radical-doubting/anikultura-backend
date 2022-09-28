<?php

namespace App\Providers;

use App\Facades\AnikulturaFacade as Anikultura;
use Orchid\Platform\Providers\FoundationServiceProvider as ServiceProvider;

class PlatformFoundationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (Anikultura::isHeadless()) {
            return;
        }

        parent::boot();
    }

    public function register(): void
    {
        if (Anikultura::isHeadless()) {
            return;
        }

        parent::register();
    }
}
