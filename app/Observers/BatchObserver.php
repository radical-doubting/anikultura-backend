<?php

namespace App\Observers;

use App\Actions\Insights\CreateCensusMetric;
use App\Models\Batch\Batch;

class BatchObserver
{
    public function saved(Batch $batch)
    {
        CreateCensusMetric::dispatch(
            $batch,
            'census-batch',
            [
                'region' => 'id',
                'province' => 'id',
                'municity' => 'id',
            ]
        );
    }
}