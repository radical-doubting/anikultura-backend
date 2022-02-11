<?php

namespace App\Observers\Site;

use App\Actions\Insights\CreateCensusMetric;
use App\Models\Site\Region;

class RegionObserver
{
    public function saved(Region $region)
    {
        CreateCensusMetric::dispatch(
            $region,
            'census-region'
        );
    }
}
