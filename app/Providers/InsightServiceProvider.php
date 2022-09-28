<?php

namespace App\Providers;

use App\Facades\Anikultura;
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
use App\Observers\FarmerReport\FarmerReportInsightObserver;
use App\Observers\Farmland\FarmlandInsightObserver;
use App\Observers\Site\MunicityInsightObserver;
use App\Observers\Site\ProvinceInsightObserver;
use App\Observers\Site\RegionInsightObserver;
use Illuminate\Support\ServiceProvider;

class InsightServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (! Anikultura::isInsightsEnabled()) {
            return;
        }

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
}
