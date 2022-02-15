<?php

namespace App\Observers\Batch;

use App\Actions\Insights\CreateCensusMetric;
use App\Actions\Insights\CreateFarmerEnrollmentMetric;
use App\Models\Batch\Batch;
use App\Models\Farmer\Farmer;

class BatchObserver
{
    public function saved(Batch $batch)
    {
        CreateCensusMetric::dispatch(
            [
                'model' => [
                    'id' => $batch->id,
                    'class' => Batch::class,
                ],
                'point' => [
                    'increment' => true,
                    'measurement' => 'census-batch',
                    'tags' => [
                        'region' => 'id',
                        'province' => 'id',
                        'municity' => 'id',
                    ],
                ],
            ]
        );
    }

    /**
     * Farmer assigned to batch event.
     */
    public function belongsToManyAttached(string $relation, Batch $batch, array $farmerIds)
    {
        if ($relation != 'farmers') {
            return;
        }

        CreateFarmerEnrollmentMetric::dispatch($batch, $farmerIds);
    }
}
