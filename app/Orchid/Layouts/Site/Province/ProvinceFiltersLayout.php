<?php

namespace App\Orchid\Layouts\Site\Province;

use App\Orchid\Filters\Site\RegionFilter;
use Orchid\Filters\Filter;
use Orchid\Screen\Layouts\Selection;

class ProvinceFiltersLayout extends Selection
{
    /**
     * @return string[]|Filter[]
     */
    public function filters(): array
    {
        return [
            RegionFilter::class,
        ];
    }
}
