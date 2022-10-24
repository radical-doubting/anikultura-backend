<?php

namespace App\Orchid\Screens\FarmerReport;

use App\Helpers\InsightsHelper;
use App\Models\FarmerReport\FarmerReport;
use App\Orchid\Layouts\FarmerReport\FarmerReportFiltersLayout;
use App\Orchid\Layouts\FarmerReport\FarmerReportListLayout;
use App\Orchid\Screens\AnikulturaListScreen;

class FarmerReportListScreen extends AnikulturaListScreen
{
    public function name(): string
    {
        return __('Farmer Report');
    }

    public function query(): array
    {
        return [
            'farmer_reports' => FarmerReport::filters()
                ->filtersApplySelection(FarmerReportFiltersLayout::class)
                ->defaultSort('id')
                ->paginate(),
        ];
    }

    public function commandBar(): array
    {
        return [
            InsightsHelper::makeLink('farmerReport'),
        ];
    }

    public function layout(): array
    {
        return [
            FarmerReportFiltersLayout::class,
            FarmerReportListLayout::class,
        ];
    }
}
