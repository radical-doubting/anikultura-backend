<?php

namespace App\Observers\Site;

use App\Actions\Insights\CreateCensusMetric;
use App\Models\Site\Municity;

class MunicityObserver
{
    public function saved(Municity $municity)
    {
        CreateCensusMetric::dispatch(
            $municity,
            'census-municipality-city',
            [
                'region' => 'id',
                'province' => 'id',
            ]
        );
    }
}
