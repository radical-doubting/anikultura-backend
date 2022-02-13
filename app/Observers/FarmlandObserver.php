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

    public function deleting(Farmland $farmland)
    {
        $this->sendInsights($farmland, false);
    }

    private function sendInsights(Farmland $farmland, bool $shouldIncrement)
    {
        CreateCensusMetric::dispatch(
            [
                'model' => [
                    'id' => $farmland->id,
                    'class' => Farmland::class,
                ],
                'point' => [
                    'increment' => $shouldIncrement,
                    'measurement' => 'census-farmland',
                    'tags' => [
                        'type' => 'id',
                        'status' => 'id',
                        'batch.region' => 'id',
                        'batch.province' => 'id',
                        'batch.municity' => 'id',
                    ],
                ],
            ]
        );

        CreateCensusMetric::dispatch(
            [
                'model' => [
                    'id' => $farmland->id,
                    'class' => Farmland::class,
                    'aggregation' => [
                        'type' => 'sum',
                        'column' => 'hectares_size',
                    ],
                ],
                'point' => [
                    'increment' => $shouldIncrement,
                    'field' => 'hectares-size',
                    'measurement' => 'census-farmland',
                    'tags' => [
                        'type' => 'id',
                        'status' => 'id',
                        'batch.region' => 'id',
                        'batch.province' => 'id',
                        'batch.municity' => 'id',
                    ],
                ],
            ]
        );
    }
}
