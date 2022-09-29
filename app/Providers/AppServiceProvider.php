<?php

namespace App\Providers;

use App\Anikultura;
use App\Models\FarmerReport\FarmerReport;
use App\Observers\FarmerReport\FarmerReportHarvestedObserver;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('anikultura', function () {
            return new Anikultura();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->environment('staging') || $this->app->environment('production')) {
            URL::forceScheme('https');
        }

        $this->registerDomainObservers();
    }

    private function registerDomainObservers(): void
    {
        FarmerReport::observe(FarmerReportHarvestedObserver::class);
    }
}
