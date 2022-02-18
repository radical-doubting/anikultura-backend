<?php

namespace App\Observers\FarmerReport;

use App\Actions\Insights\CreateCensusMetric;
use App\Models\FarmerReport\FarmerReport;
use App\Traits\AsInsightSender;

class FarmerReportObserver
{
    use AsInsightSender;

    private function sendInsights($model, bool $shouldIncrement)
    {
        CreateCensusMetric::dispatch(
            [
                'model' => [
                    'id' => $model->id,
                    'class' => FarmerReport::class,
                ],
                'point' => [
                    'increment' => $shouldIncrement,
                    'measurement' => 'census-farmer-report',
                    'tags' => [
                        'crop' => 'id',
                        'seed_stage' => 'id',
                        'farmland.batch.region' => 'id',
                        'farmland.batch.province' => 'id',
                        'farmland.batch.municity' => 'id',
                    ],
                ],
            ]
        );
    }
}
