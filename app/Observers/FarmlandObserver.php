<?php

namespace App\Observers;

use App\Actions\Insights\CreateInsightMetric;
use App\Models\Farmland\Farmland;
use InfluxDB2\Point;

class FarmlandObserver
{
    /**
     * Handle the Farmland "saved" event.
     *
     * @param  \App\Models\Farmland\Farmland  $farmland
     * @return void
     */
    public function saved(Farmland $farmland)
    {
        CreateInsightMetric::dispatch([
            Point::measurement('census-farmland')
                ->addField('hectares_size', $farmland->hectares_size)
                ->addTag('type', $farmland->type->slug)
                ->addTag('status', $farmland->status->slug)
                ->addTag('region', $farmland->batch->region->slug)
                ->addTag('province', $farmland->batch->province->slug)
                ->addTag('municity', $farmland->batch->municity->slug)
                ->time(time()),
        ]);
    }
}
