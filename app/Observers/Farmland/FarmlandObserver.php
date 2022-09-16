<?php

namespace App\Observers\Farmland;

use App\Helpers\InsightsHelper;
use App\Models\Farmland\Farmland;
use App\Traits\AsInsightSender;
use Illuminate\Database\Eloquent\Model;

class FarmlandObserver
{
    use AsInsightSender;

    /**
     * @param  Farmland  $model
     */
    private function sendInsights(Model $model, bool $shouldIncrement): void
    {
        $labels = [
            'type' => $model->type->slug,
            'status' => $model->status->slug,
            'region' => $model->batch->region->slug,
            'province' => $model->batch->province->slug,
            'municity' => $model->batch->municity->slug,
        ];

        $hectares = $model->hectares_size;

        if ($shouldIncrement) {
            InsightsHelper::incrementGauge('farmland_total', $labels);
            InsightsHelper::incrementGauge('farmland_hectares', $labels, $hectares);
        } else {
            InsightsHelper::decrementGauge('farmland_total', $labels);
            InsightsHelper::decrementGauge('farmland_hectares', $labels, $hectares);
        }
    }
}
