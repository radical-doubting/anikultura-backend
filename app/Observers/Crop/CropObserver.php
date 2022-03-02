<?php

namespace App\Observers\Crop;

use App\Actions\Insights\Crop\CreateCropProfitMetric;
use App\Traits\AsInsightSender;

class CropObserver
{
    use AsInsightSender;

    private function sendInsights($model, bool $shouldIncrement)
    {
        CreateCropProfitMetric::dispatch($model);
    }
}
