<?php

namespace App\Observers\Batch;

use App\Helpers\InsightsHelper;
use App\Models\Batch\Batch;
use App\Traits\AsInsightSender;
use Illuminate\Database\Eloquent\Model;

class BatchObserver
{
    use AsInsightSender;

    private function sendInsights(Model $model, bool $shouldIncrement)
    {
        $labels = [
            'region' => $model->region->slug,
            'province' => $model->province->slug,
            'municity' => $model->municity->slug,
        ];

        if ($shouldIncrement) {
            InsightsHelper::incrementGauge('batch_total', $labels);
        } else {
            InsightsHelper::decrementGauge('batch_total', $labels);
        }
    }

    /**
     * Handles the farmer assigned to batch event.
     */
    public function belongsToManyAttached(string $relation, Batch $batch, array $farmerIds)
    {
        if ($relation != 'farmers') {
            return;
        }

        $farmerAssignedCount = count($farmerIds);

        InsightsHelper::incrementGauge('farmer_total', [
            'region' => $batch->region->slug,
            'province' => $batch->province->slug,
            'municity' => $batch->municity->slug,
        ], $farmerAssignedCount);
    }

    /**
     * Handles the farmer unassigned to batch event.
     */
    public function belongsToManyDetached(string $relation, Batch $batch, array $farmerIds)
    {
        if ($relation != 'farmers') {
            return;
        }

        $farmerAssignedCount = count($farmerIds);

        InsightsHelper::decrementGauge('farmer_total', [
            'region' => $batch->region->slug,
            'province' => $batch->province->slug,
            'municity' => $batch->municity->slug,
        ], $farmerAssignedCount);
    }
}
