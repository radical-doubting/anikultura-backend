<?php

namespace App\Providers;

use App\Models\Batch\Batch;
use App\Models\Farmland\Farmland;
use App\Observers\BatchObserver;
use App\Observers\FarmlandObserver;
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
        Batch::observe(BatchObserver::class);
        Farmland::observe(FarmlandObserver::class);
    }
}
