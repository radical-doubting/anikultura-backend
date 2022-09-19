<?php

namespace App\Orchid\Layouts\Batch;

use App\Orchid\Filters\Site\MunicityFilter;
use App\Orchid\Filters\Site\ProvinceFilter;
use App\Orchid\Filters\Site\RegionFilter;
use Orchid\Filters\Filter;
use Orchid\Screen\Layouts\Selection;

class BatchFiltersLayout extends Selection
{
    /**
     * @return string[]|Filter[]
     */
    public function filters(): array
    {
        return [
            RegionFilter::class,
            ProvinceFilter::class,
            MunicityFilter::class,
        ];
    }
}
