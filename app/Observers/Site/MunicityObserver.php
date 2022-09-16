<?php

namespace App\Observers\Site;

use App\Helpers\InsightsHelper;
use App\Models\Site\Municity;
use App\Traits\AsInsightSender;
use Illuminate\Database\Eloquent\Model;

class MunicityObserver
{
    use AsInsightSender;

    /**
     * @param  Municity  $model
     */
    private function sendInsights(Model $model, bool $shouldIncrement): void
    {
        $labels = [
            'region' => $model->region->slug,
            'province' => $model->province->slug,
        ];

        if ($shouldIncrement) {
            InsightsHelper::incrementGauge('municipality_city_total', $labels);
        } else {
            InsightsHelper::decrementGauge('municipality_city_total', $labels);
        }
    }
}
