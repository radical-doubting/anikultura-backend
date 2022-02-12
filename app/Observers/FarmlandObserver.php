<?php

namespace App\Observers;

use App\Actions\Insights\CreateCensusMetric;
use App\Models\Farmland\Farmland;

class FarmlandObserver
{
    public function saved(Farmland $farmland)
    {
        $this->sendInsights($farmland, true);
    }

    public function deleted(Farmland $farmland)
    {
        $this->sendInsights($farmland, false);
    }

    private function sendInsights(Farmland $farmland, bool $shouldIncrement)
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
            ],
            $shouldIncrement
        );

        CreateCensusMetric::dispatch(
            $farmland,
            'census-farmland',
            [
                'type' => 'id',
                'status' => 'id',
                'batch.region' => 'id',
                'batch.province' => 'id',
                'batch.municity' => 'id',
            ],
            $shouldIncrement,
            'hectares-size',
            [
                'type' => 'sum',
                'column' => 'hectares_size',
            ]
        );
    }
}
