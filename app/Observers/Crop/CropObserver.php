<?php

namespace App\Observers\Crop;

use App\Helpers\InsightsHelper;
use App\Traits\AsInsightSender;
use Illuminate\Database\Eloquent\Model;

class CropObserver
{
    use AsInsightSender;

    private function sendInsights(Model $model, bool $shouldIncrement)
    {
        $profitPerKg = (float) $model->profit_per_kg;
        $netProfitCostRatio = (float) $model->net_profit_cost_ratio;

        if ($shouldIncrement) {
            InsightsHelper::incrementGauge('crop_profit_per_kg_pesos', [
                'crop' => $model->slug,
            ], $profitPerKg);

            InsightsHelper::incrementGauge('crop_net_profit_cost_ratio', [
                'crop' => $model->slug,
            ], $netProfitCostRatio);
        } else {
            InsightsHelper::decrementGauge('crop_profit_per_kg_pesos', [
                'crop' => $model->slug,
            ], $profitPerKg);

            InsightsHelper::decrementGauge('crop_net_profit_cost_ratio', [
                'crop' => $model->slug,
            ], $netProfitCostRatio);
        }
    }
}
