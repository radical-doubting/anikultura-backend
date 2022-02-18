<?php

namespace App\Observers\Crop;

use App\Actions\Insights\CreateCropMetric;
use App\Traits\AsInsightSender;

class CropObserver
{
    use AsInsightSender;

    private function sendInsights($model, bool $shouldIncrement)
    {
        CreateCropMetric::dispatch($model);
    }
}
