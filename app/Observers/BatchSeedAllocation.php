<?php

namespace App\Observers;

use App\Actions\Insights\CreateCensusMetric;
use App\Models\Batch\BatchSeedAllocation;

class BatchSeedAllocation
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
