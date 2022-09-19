<?php

namespace App\Observers\Site;

use App\Helpers\InsightsHelper;
use App\Traits\AsInsightSender;
use Illuminate\Database\Eloquent\Model;

class ProvinceObserver
{
    use AsInsightSender;

    private function sendInsights(Model $model, bool $shouldIncrement)
    {
        $labels = [
            'region' => $model->region->slug,
        ];

        if ($shouldIncrement) {
            InsightsHelper::incrementGauge('province_total', $labels);
        } else {
            InsightsHelper::decrementGauge('province_total', $labels);
        }
    }
}
