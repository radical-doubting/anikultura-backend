<?php

namespace App\Orchid\Layouts\Site\Municity;

use App\Orchid\Filters\Site\ProvinceFilter;
use App\Orchid\Filters\Site\RegionFilter;
use Orchid\Filters\Filter;
use Orchid\Screen\Layouts\Selection;

class MunicityFiltersLayout extends Selection
{
    /**
     * @return string[]|Filter[]
     */
    public function filters(): array
    {
        return [
            RegionFilter::class,
            ProvinceFilter::class,
        ];
    }
}
