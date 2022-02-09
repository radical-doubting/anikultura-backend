<?php

namespace App\Observers;

use App\Actions\Insights\CreateInsightMetric;
use App\Actions\Insights\RetrieveModelCount;
use App\Models\Batch\Batch;
use InfluxDB2\Point;

class BatchObserver
{
    public function saved(Batch $batch)
    {
        $newCount = RetrieveModelCount::run(
            $batch,
            [
                'region' => 'id',
                'province' => 'id',
                'municity' => 'id',
            ],
        );

        CreateInsightMetric::dispatch([
            Point::measurement('census-batch')
                ->addField('count', $newCount)
                ->addTag('region', $batch->region->slug)
                ->addTag('province', $batch->province->slug)
                ->addTag('municity', $batch->municity->slug)
                ->time(time()),
        ]);
    }
}
