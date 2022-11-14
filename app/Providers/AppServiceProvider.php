<?php

namespace App\Providers;

use App\Anikultura;
use App\Models\FarmerReport\FarmerReport;
use App\Observers\FarmerReport\FarmerReportHarvestedObserver;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
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
        $this->registerValidationRules();
    }

    private function registerDomainObservers(): void
    {
        FarmerReport::observe(FarmerReportHarvestedObserver::class);
    }

    private function registerValidationRules(): void
    {
        // Match alphanumeric, dashes, and numbers
        Validator::extend(
            'alpha_num_space_dash',
            fn ($attribute, $value) => preg_match('/^[\pL\s\d\'-]+$/u', $value)
        );
    }
}
