<?php

namespace App\Observers\Site;

use App\Helpers\InsightsHelper;
use App\Traits\AsInsightSender;

class RegionObserver
{
    use AsInsightSender;

    private function sendInsights($model, bool $shouldIncrement)
    {
        if ($shouldIncrement) {
            InsightsHelper::incrementGauge('region_total');
        } else {
            InsightsHelper::decrementGauge('region_total');
        }
    }
}
