<?php

namespace App\Observers\Site;

use App\Actions\Insights\CreateCensusMetric;
use App\Models\Site\Municity;
use App\Traits\AsInsightSender;

class MunicityObserver
{
    use AsInsightSender;

    private function sendInsights($model, bool $shouldIncrement)
    {
        CreateCensusMetric::dispatch(
            [
                'model' => [
                    'id' => $model->id,
                    'class' => Municity::class,
                ],
                'point' => [
                    'increment' => $shouldIncrement,
                    'measurement' => 'census-municipality-city',
                    'tags' => [
                        'region' => 'id',
                        'province' => 'id',
                    ],
                ],
            ]
        );
    }
}
