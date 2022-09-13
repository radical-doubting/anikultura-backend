<?php

namespace App\Observers\Site;

use App\Helpers\InsightsHelper;
use App\Traits\AsInsightSender;

class MunicityObserver
{
    use AsInsightSender;

    private function sendInsights($model, bool $shouldIncrement)
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
