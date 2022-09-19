<?php

namespace App\Providers;

use App\Anikultura;
use App\Models\Batch\Batch;
use App\Models\Batch\BatchSeedAllocation;
use App\Models\Crop\Crop;
use App\Models\FarmerReport\FarmerReport;
use App\Models\Farmland\Farmland;
use App\Models\Site\Municity;
use App\Models\Site\Province;
use App\Models\Site\Region;
use App\Observers\Batch\BatchObserver;
use App\Observers\Batch\BatchSeedAllocationObserver;
use App\Observers\Crop\CropObserver;
use App\Observers\FarmerReport\FarmerReportObserver;
use App\Observers\Farmland\FarmlandObserver;
use App\Observers\Site\MunicityObserver;
use App\Observers\Site\ProvinceObserver;
use App\Observers\Site\RegionObserver;
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

        $this->registerObservers();
    }

    /**
     * Register application observers by Filename and Model.
     */
    private function registerObservers()
    {
        // Site observers
        Region::observe(RegionObserver::class);
        Province::observe(ProvinceObserver::class);
        Municity::observe(MunicityObserver::class);

        // Batch and farmer enrollment observers
        Batch::observe(BatchObserver::class);
        BatchSeedAllocation::observe(BatchSeedAllocationObserver::class);

        // Farmland observer
        Farmland::observe(FarmlandObserver::class);
        Crop::observe(CropObserver::class);
        FarmerReport::observe(FarmerReportObserver::class);
    }
}
