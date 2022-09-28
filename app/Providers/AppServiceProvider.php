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
use App\Observers\Batch\BatchInsightObserver;
use App\Observers\Batch\BatchSeedAllocationInsightObserver;
use App\Observers\Crop\CropInsightObserver;
use App\Observers\FarmerReport\FarmerReportHarvestedObserver;
use App\Observers\FarmerReport\FarmerReportInsightObserver;
use App\Observers\Farmland\FarmlandInsightObserver;
use App\Observers\Site\MunicityInsightObserver;
use App\Observers\Site\ProvinceInsightObserver;
use App\Observers\Site\RegionInsightObserver;
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
        $this->registerInsightObservers();
    }

    private function registerInsightObservers(): void
    {
        Region::observe(RegionInsightObserver::class);
        Province::observe(ProvinceInsightObserver::class);
        Municity::observe(MunicityInsightObserver::class);

        Batch::observe(BatchInsightObserver::class);
        BatchSeedAllocation::observe(BatchSeedAllocationInsightObserver::class);

        Farmland::observe(FarmlandInsightObserver::class);
        Crop::observe(CropInsightObserver::class);
        FarmerReport::observe(FarmerReportInsightObserver::class);
    }

    private function registerDomainObservers(): void
    {
        FarmerReport::observe(FarmerReportHarvestedObserver::class);
    }
}
