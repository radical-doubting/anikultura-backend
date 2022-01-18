<?php

namespace App\Observers;

use App\Actions\Insights\CreateInsightMetric;
use App\Models\Site\Region;
use InfluxDB2\Point;

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
        CreateInsightMetric::run([
            Point::measurement('h2o_levels')
                ->addTag('location', $region->slug)
                ->addField('level', 2)
                ->time(time()),
        ]);
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
