<?php

namespace App\Observers\Batch;

use App\Actions\Insights\CreateCensusMetric;
use App\Models\Batch\BatchSeedAllocation;
use App\Traits\AsInsightSender;

class BatchSeedAllocationObserver
{
    use AsInsightSender;

    private function sendInsights($model, bool $shouldIncrement)
    {
        CreateCensusMetric::dispatch(
            [
                'model' => [
                    'id' => $model->id,
                    'class' => BatchSeedAllocation::class,
                    'aggregation' => [
                        'type' => 'sum',
                        'column' => 'seed_amount',
                    ],
                ],
                'point' => [
                    'increment' => $shouldIncrement,
                    'field' => 'seed-amount',
                    'measurement' => 'census-seed-allocation',
                    'tags' => [
                        'crop' => 'id',
                        'batch.region' => 'id',
                        'batch.province' => 'id',
                        'batch.municity' => 'id',
                    ],
                ],
            ]
        );
    }
}
