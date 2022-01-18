<?php

namespace App\Providers;

use App\Models\Site\Region;
use App\Observers\RegionObserver;
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
        //
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

        $this->registerObservers();
    }

    /**
     * Register application observers by Filename and Model.
     */
    private function registerObservers()
    {
        Region::observe(RegionObserver::class);
    }
}
