<?php

namespace App\Orchid\Screens\FarmerReport;

use App\Models\FarmerReport\FarmerReport;
use App\Orchid\Layouts\FarmerReport\FarmerReportFiltersLayout;
use App\Orchid\Layouts\FarmerReport\FarmerReportListLayout;
use App\Orchid\Screens\AnikulturaListScreen;
use Orchid\Screen\Actions\Link;

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

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make(__('Add'))
                ->icon('plus')
                ->route('platform.farmer-reports.create'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            FarmerReportFiltersLayout::class,
            FarmerReportListLayout::class,
        ];
    }
}
