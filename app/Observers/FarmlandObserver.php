<?php

namespace App\Observers;

use App\Actions\Insights\CreateCensusMetric;
use App\Models\Farmland\Farmland;

class FarmlandObserver
{
    public function saved(Farmland $farmland)
    {
        CreateCensusMetric::dispatch(
            $farmland,
            'census-farmland',
            [
                'type' => 'id',
                'status' => 'id',
                'batch.region' => 'id',
                'batch.province' => 'id',
                'batch.municity' => 'id',
            ]
        );
    }
}
