<?php

namespace App\Orchid\Layouts\Batch;

use App\Orchid\Filters\Site\MunicityFilter;
use App\Orchid\Filters\Site\ProvinceFilter;
use App\Orchid\Filters\Site\RegionFilter;
use App\Orchid\Layouts\AnikulturaFilterLayout;

class BatchFiltersLayout extends AnikulturaFilterLayout
{
    public function filters(): iterable
    {
        return [
            RegionFilter::class,
            ProvinceFilter::class,
            MunicityFilter::class,
        ];
    }
}
