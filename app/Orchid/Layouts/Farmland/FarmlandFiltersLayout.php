<?php

namespace App\Orchid\Layouts\Farmland;

use App\Orchid\Filters\Batch\BatchFilter;
use App\Orchid\Filters\Farmland\FarmlandStatusFilter;
use App\Orchid\Filters\Farmland\FarmlandTypeFilter;
use Orchid\Filters\Filter;
use Orchid\Screen\Layouts\Selection;

class FarmlandFiltersLayout extends Selection
{
    /**
     * @return string[]|Filter[]
     */
    public function filters(): array
    {
        return [
            BatchFilter::class,
            FarmlandTypeFilter::class,
            FarmlandStatusFilter::class,
        ];
    }
}
