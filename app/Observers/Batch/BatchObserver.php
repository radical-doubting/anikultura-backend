<?php

namespace App\Observers\Batch;

use App\Actions\Insights\CreateCensusMetric;
use App\Actions\Insights\CreateFarmerEnrollmentMetric;
use App\Models\Batch\Batch;
use App\Models\Farmer\Farmer;
use App\Traits\AsInsightSender;

class BatchObserver
{
    use AsInsightSender;

    private function sendInsights($model, bool $shouldIncrement)
    {
        CreateCensusMetric::dispatch(
            [
                'model' => [
                    'id' => $model->id,
                    'class' => Batch::class,
                ],
                'point' => [
                    'increment' => $shouldIncrement,
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
