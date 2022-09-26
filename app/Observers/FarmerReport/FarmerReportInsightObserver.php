<?php

namespace App\Observers\FarmerReport;

use App\Helpers\InsightsHelper;
use App\Models\FarmerReport\FarmerReport;
use App\Traits\AsInsightSender;
use Illuminate\Database\Eloquent\Model;

class FarmerReportInsightObserver
{
    use AsInsightSender;

    /**
     * @param  FarmerReport  $model
     */
    private function sendInsights(Model $model, bool $shouldIncrement): void
    {
        $this->createCensusMetric($model, $shouldIncrement);
        $this->createEstimatedYieldMetric($model, $shouldIncrement);
    }

    /**
     * @param  FarmerReport  $model
     */
    private function createCensusMetric(Model $model, bool $shouldIncrement): void
    {
        $labels = [
            'crop' => $model->crop->slug,
            'seed_stage' => $model->seedStage->slug,
            'region' => $model->farmland->batch->region->slug,
            'province' => $model->farmland->batch->province->slug,
            'municity' => $model->farmland->batch->municity->slug,
        ];

        if ($shouldIncrement) {
            InsightsHelper::incrementGauge('farmer_report_total', $labels);
        } else {
            InsightsHelper::decrementGauge('farmer_report_total', $labels);
        }
    }

    /**
     * @param  FarmerReport  $model
     */
    private function createEstimatedYieldMetric(Model $model, bool $shouldIncrement): void
    {
        if (! $model->isPlanted()) {
            return;
        }

        $estimatedYieldAmount = $this->convertKgToGrams($model->estimated_yield_amount);
        $estimatedYieldDateLower = $model->estimated_yield_date_lower_bound;
        $estimatedYieldDateUpper = $model->estimated_yield_date_upper_bound;

        $labels = [
            'crop' => $model->crop->slug,
            'region' => $model->farmland->batch->region->slug,
            'province' => $model->farmland->batch->province->slug,
            'municity' => $model->farmland->batch->municity->slug,
            'yield_date_earliest' => $this->getEstimatedDateTag($estimatedYieldDateLower),
            'yield_date_latest' => $this->getEstimatedDateTag($estimatedYieldDateUpper),
        ];

        if ($shouldIncrement) {
            InsightsHelper::incrementGauge(
                'farmer_report_estimated_yield_grams',
                $labels,
                $estimatedYieldAmount
            );
        } else {
            InsightsHelper::decrementGauge(
                'farmer_report_estimated_yield_grams',
                $labels,
                $estimatedYieldAmount
            );
        }
    }

    private function convertKgToGrams(float $kg): float
    {
        return $kg * 1000;
    }

    private function getEstimatedDateTag(string $estimatedDate): string
    {
        return date('m-Y', strtotime($estimatedDate));
    }
}
