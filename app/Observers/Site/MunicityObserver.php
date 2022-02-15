<?php

namespace App\Observers\Site;

use App\Actions\Insights\CreateCensusMetric;
use App\Models\Site\Municity;

class MunicityObserver
{
    public function saved(Municity $municity)
    {
        CreateCensusMetric::dispatch(
            [
                'model' => [
                    'id' => $municity->id,
                    'class' => Municity::class,
                ],
                'point' => [
                    'increment' => true,
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
