<?php

namespace App\Observers;

use App\Actions\Insights\CreateCensusMetric;
use App\Models\Farmland\Farmland;
use App\Traits\AsInsightSender;

class FarmlandObserver
{
    use AsInsightSender;

    private function sendInsights($model, bool $shouldIncrement)
    {
        CreateCensusMetric::dispatch(
            [
                'model' => [
                    'id' => $model->id,
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
                    'id' => $model->id,
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
