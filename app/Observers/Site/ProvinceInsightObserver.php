<?php

declare(strict_types=1);

namespace App\Observers\Site;

use App\Helpers\InsightsHelper;
use App\Models\Site\Province;
use App\Traits\AsInsightSender;
use Illuminate\Database\Eloquent\Model;

class ProvinceInsightObserver
{
    use AsInsightSender;

    /**
     * @param  Province  $model
     */
    private function sendInsights(Model $model, bool $shouldIncrement): void
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
