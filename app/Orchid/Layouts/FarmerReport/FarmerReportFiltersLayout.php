<?php

namespace App\Orchid\Layouts\FarmerReport;

use App\Orchid\Filters\Crop\CropFilter;
use App\Orchid\Filters\Crop\SeedStageFilter;
use Orchid\Filters\Filter;
use Orchid\Screen\Layouts\Selection;

class FarmerReportFiltersLayout extends Selection
{
    /**
     * @return string[]|Filter[]
     */
    public function filters(): array
    {
        return [
            CropFilter::class,
            SeedStageFilter::class,
        ];
    }
}
