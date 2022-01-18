<?php

namespace App\Observers;

use App\Actions\Insights\CreateInsight;
use App\Actions\Insights\CreateInsightMetric;
use App\Models\Site\Region;

class RegionObserver
{
    /**
     * Handle the Region "created" event.
     *
     * @param  \App\Models\Site\Region  $region
     * @return void
     */
    public function created(Region $region)
    {
        CreateInsightMetric::run('region');
    }

    /**
     * Handle the Region "updated" event.
     *
     * @param  \App\Models\Site\Region  $region
     * @return void
     */
    public function updated(Region $region)
    {
        //
    }

    /**
     * Handle the Region "deleted" event.
     *
     * @param  \App\Models\Site\Region  $region
     * @return void
     */
    public function deleted(Region $region)
    {
        //
    }

    /**
     * Handle the Region "restored" event.
     *
     * @param  \App\Models\Site\Region  $region
     * @return void
     */
    public function restored(Region $region)
    {
        //
    }

    /**
     * Handle the Region "force deleted" event.
     *
     * @param  \App\Models\Site\Region  $region
     * @return void
     */
    public function forceDeleted(Region $region)
    {
        //
    }
}
