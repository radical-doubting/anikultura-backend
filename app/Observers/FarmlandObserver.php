<?php

namespace App\Observers;

use App\Actions\Insights\CreateInsightMetric;
use App\Actions\Insights\RetrieveModelCount;
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
        $newCount = RetrieveModelCount::run(
            $farmland,
            [
                'type' => 'id',
                'status' => 'id',
                'batch.region' => 'id',
                'batch.province' => 'id',
                'batch.municity' => 'id',
            ],
        );

        $farmlandBatch = $farmland->batch;

        CreateInsightMetric::dispatch([
            Point::measurement('census-farmland')
                ->addField('count', $newCount)
                ->addTag('type', $farmland->type->slug)
                ->addTag('status', $farmland->status->slug)
                ->addTag('region', $farmlandBatch->region->slug)
                ->addTag('province', $farmlandBatch->province->slug)
                ->addTag('municity', $farmlandBatch->municity->slug)
                ->time(time()),
        ]);
    }
}
