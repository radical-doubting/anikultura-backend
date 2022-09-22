<?php

namespace App\Observers\Crop;

use App\Helpers\InsightsHelper;
use App\Models\Crop\Crop;
use App\Traits\AsInsightSender;
use Illuminate\Database\Eloquent\Model;

class CropObserver
{
    use AsInsightSender;

    /**
     * @param  Crop  $model
     */
    private function sendInsights(Model $model, bool $shouldIncrement): void
    {
        $profitPerKg = $model->profit_per_kg;
        $netProfitCostRatio = $model->net_profit_cost_ratio;

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
