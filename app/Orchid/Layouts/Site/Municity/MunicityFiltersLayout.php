<?php

namespace App\Orchid\Layouts\Site\Municity;

use App\Orchid\Filters\Site\ProvinceFilter;
use App\Orchid\Filters\Site\RegionFilter;
use App\Orchid\Layouts\AnikulturaFilterLayout;

class MunicityFiltersLayout extends AnikulturaFilterLayout
{
    public function filters(): iterable
    {
        return [
            RegionFilter::class,
            ProvinceFilter::class,
        ];
    }
}
