<?php

namespace App\Observers\Site;

use App\Actions\Insights\CreateCensusMetric;
use App\Models\Site\Province;
use App\Traits\AsInsightSender;

class ProvinceObserver
{
    use AsInsightSender;

    private function sendInsights($model, bool $shouldIncrement)
    {
        CreateCensusMetric::dispatch(
            [
                'model' => [
                    'id' => $model->id,
                    'class' => Province::class,
                ],
                'point' => [
                    'increment' => $shouldIncrement,
                    'measurement' => 'census-province',
                    'tags' => [
                        'region' => 'id',
                    ],
                ],
            ]
        );
    }
}
