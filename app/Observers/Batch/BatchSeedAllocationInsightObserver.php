<?php

namespace App\Observers\Batch;

use App\Helpers\InsightsHelper;
use App\Models\Batch\BatchSeedAllocation;
use App\Traits\AsInsightSender;
use Illuminate\Database\Eloquent\Model;

class BatchSeedAllocationInsightObserver
{
    use AsInsightSender;

    /**
     * @param  BatchSeedAllocation  $model
     */
    private function sendInsights(Model $model, bool $shouldIncrement): void
    {
        $labels = [
            'crop' => $model->crop->slug,
            'region' => $model->batch->region->slug,
            'province' => $model->batch->province->slug,
            'municity' => $model->batch->municity->slug,
        ];

        if ($shouldIncrement) {
            InsightsHelper::incrementGauge(
                'batch_seed_allocation_total',
                $labels,
                $model->seed_amount
            );
        } else {
            InsightsHelper::decrementGauge(
                'batch_seed_allocation_total',
                $labels,
                $model->seed_amount
            );
        }
    }
}
