<?php

namespace App\Observers;

use App\Actions\Insights\CreateInsightMetric;
use App\Actions\Insights\RetrieveModelCount;
use App\Models\Site\Region;
use InfluxDB2\Point;

class RegionObserver
{
    /**
     * Handle the Region "saved" event.
     *
     * @param  \App\Models\Site\Region  $region
     * @return void
     */
    public function saved(Region $region)
    {
        $newCount = RetrieveModelCount::run(
            $region
        );

        CreateInsightMetric::dispatch([
            Point::measurement('census-region')
                ->addField('count', $newCount)
                ->time(time()),
        ]);
    }
}
