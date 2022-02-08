<?php

namespace App\Observers;

use App\Actions\Insights\CreateInsightMetric;
use App\Models\Batch\Batch;
use InfluxDB2\Point;

class BatchObserver
{
    /**
     * Handle the Batch "saved" event.
     *
     * @param  \App\Models\Batch\Batch  $batch
     * @return void
     */
    public function saved(Batch $batch)
    {
        CreateInsightMetric::dispatch([
            Point::measurement('census-batch')
                ->addField('id', $batch->id)
                ->addTag('region', $batch->region->slug)
                ->addTag('province', $batch->province->slug)
                ->addTag('municity', $batch->municity->slug)
                ->time(time()),
        ]);
    }
}
