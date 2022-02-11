<?php

namespace App\Observers\Site;

use App\Actions\Insights\CreateCensusMetric;
use App\Models\Site\Province;

class ProvinceObserver
{
    public function saved(Province $province)
    {
        CreateCensusMetric::dispatch(
            $province,
            'census-province',
            [
                'region' => 'id',
            ]
        );
    }
}
