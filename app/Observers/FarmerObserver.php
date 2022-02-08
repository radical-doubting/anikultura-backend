<?php

namespace App\Observers;

use App\Actions\Insights\CreateInsightMetric;
use App\Models\Farmer\Farmer;
use InfluxDB2\Point;

class FarmerObserver
{
    /**
     * Handle the Farmer "saved" event.
     *
     * @param  \App\Models\Farmer\Farmer  $farmer
     * @return void
     */
    public function saved(Farmer $farmer)
    {
        CreateInsightMetric::dispatch([
            Point::measurement('census-')
                ->addTag('batch', $farmer->slug)
                ->addField('level', 2)
                ->time(time()),
        ]);
    }
}
