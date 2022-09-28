<?php

namespace App\Observers\Site;

use App\Helpers\InsightsHelper;
use App\Models\Site\Region;
use App\Traits\AsInsightSender;
use Illuminate\Database\Eloquent\Model;

class RegionInsightObserver
{
    use AsInsightSender;

    /**
     * @param  Region  $model
     */
    private function sendInsights(Model $model, bool $shouldIncrement): void
    {
        if ($shouldIncrement) {
            InsightsHelper::incrementGauge('region_total');
        } else {
            InsightsHelper::decrementGauge('region_total');
        }
    }
}
