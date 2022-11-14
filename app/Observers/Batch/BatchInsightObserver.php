<?php

namespace App\Observers\Batch;

use App\Helpers\InsightsHelper;
use App\Models\Batch\Batch;
use App\Traits\AsInsightSender;
use Illuminate\Database\Eloquent\Model;

class BatchInsightObserver
{
    use AsInsightSender;

    /**
     * @param  Batch  $model
     */
    private function sendInsights(Model $model, bool $shouldIncrement): void
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
     *
     * @param  Batch  $model
     */
    public function belongsToManyAttached(string $relation, mixed $model, array $farmerIds): void
    {
        if ($relation != 'farmers') {
            return;
        }

        $farmerAssignedCount = count($farmerIds);

        InsightsHelper::incrementGauge('farmer_total', [
            'region' => $model->region->slug,
            'province' => $model->province->slug,
            'municity' => $model->municity->slug,
        ], $farmerAssignedCount);
    }

    /**
     * Handles the farmer unassigned to batch event.
     *
     * @param  Batch  $model
     */
    public function belongsToManyDetached(string $relation, mixed $model, array $farmerIds): void
    {
        if ($relation != 'farmers') {
            return;
        }

        $farmerAssignedCount = count($farmerIds);

        InsightsHelper::decrementGauge('farmer_total', [
            'region' => $model->region->slug,
            'province' => $model->province->slug,
            'municity' => $model->municity->slug,
        ], $farmerAssignedCount);
    }
}
