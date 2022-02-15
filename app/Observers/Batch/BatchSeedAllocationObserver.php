<?php

namespace App\Observers\Batch;

use App\Actions\Insights\CreateCensusMetric;
use App\Models\Batch\BatchSeedAllocation;

class BatchSeedAllocationObserver
{
    public function saved(BatchSeedAllocation $batchSeedAllocation)
    {
        CreateCensusMetric::dispatch(
            [
                'model' => [
                    'id' => $batchSeedAllocation->id,
                    'class' => BatchSeedAllocation::class,
                    'aggregation' => [
                        'type' => 'sum',
                        'column' => 'seed_amount',
                    ],
                ],
                'point' => [
                    'increment' => true,
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
