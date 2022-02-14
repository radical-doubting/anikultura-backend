<?php

namespace App\Observers;

use App\Actions\Insights\CreateInsightMetric;
use App\Models\Farmer\Farmer;
use InfluxDB2\Point;

class FarmerObserver
{
    public function saved(Farmer $farmer)
    {
        $points = [];

        foreach ($farmer->batches as $farmerBatch) {
            $points[] = Point::measurement('census-farmer')
                ->addField('level', 2)
                ->addTag('region', $farmerBatch->region->slug)
                ->addTag('province', $farmerBatch->province->slug)
                ->addTag('municity', $farmerBatch->municity->slug)
                ->time(time());
        }

        CreateInsightMetric::dispatch($points);
    }
}
