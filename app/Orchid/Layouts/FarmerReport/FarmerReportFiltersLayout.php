<?php

namespace App\Orchid\Layouts\FarmerReport;

use App\Orchid\Filters\Crop\CropFilter;
use App\Orchid\Filters\Crop\SeedStageFilter;
use App\Orchid\Layouts\AnikulturaFilterLayout;

class FarmerReportFiltersLayout extends AnikulturaFilterLayout
{
    public function filters(): iterable
    {
        return [
            CropFilter::class,
            SeedStageFilter::class,
        ];
    }
}
