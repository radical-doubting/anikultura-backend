<?php

namespace App\Orchid\Screens\FarmerReport;

use App\Models\FarmerReport;
use App\Orchid\Layouts\FarmerReport\FarmerReportListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class FarmerReportListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Farmer Report';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Farmer reports under the SM KSK SAP Program';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'farmer_reports' => FarmerReport::filters()
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
                ->route('platform.farmer.reports.create'),
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
            FarmerReportListLayout::class,
        ];
    }
}
