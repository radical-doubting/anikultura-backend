<?php

namespace App\Orchid\Layouts\Farmland;

use App\Orchid\Filters\Batch\BatchFilter;
use App\Orchid\Filters\Farmland\FarmlandStatusFilter;
use App\Orchid\Filters\Farmland\FarmlandTypeFilter;
use App\Orchid\Layouts\AnikulturaFilterLayout;

class FarmlandFiltersLayout extends AnikulturaFilterLayout
{
    public function filters(): iterable
    {
        return [
            BatchFilter::class,
            FarmlandTypeFilter::class,
            FarmlandStatusFilter::class,
        ];
    }
}
