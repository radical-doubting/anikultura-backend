<?php

namespace App\Orchid\Layouts\Site\Province;

use App\Orchid\Filters\Site\RegionFilter;
use App\Orchid\Layouts\AnikulturaFilterLayout;

class ProvinceFiltersLayout extends AnikulturaFilterLayout
{
    public function filters(): iterable
    {
        return [
            RegionFilter::class,
        ];
    }
}
