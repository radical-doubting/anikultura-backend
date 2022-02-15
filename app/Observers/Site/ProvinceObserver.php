<?php

namespace App\Observers\Site;

use App\Actions\Insights\CreateCensusMetric;
use App\Models\Site\Province;

class ProvinceObserver
{
    public function saved(Province $province)
    {
        CreateCensusMetric::dispatch(
            [
                'model' => [
                    'id' => $province->id,
                    'class' => Province::class,
                ],
                'point' => [
                    'increment' => true,
                    'measurement' => 'census-province',
                    'tags' => [
                        'region' => 'id',
                    ],
                ],
            ]
        );
    }
}
