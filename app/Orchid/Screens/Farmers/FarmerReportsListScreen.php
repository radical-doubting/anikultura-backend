<?php

namespace App\Orchid\Screens\Farmers;

use App\Models\farmer_reports;
use App\Orchid\Layouts\Farmers\FarmerReportsListLayout;
use Orchid\Screen\Screen;

class FarmerReportsListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Farmer Reports Dashboard';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Farmer Reports under the SM KSK SAP Program';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'farmer_reports' => farmer_reports::all()
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            FarmerReportsListLayout::class
        ];
    }
}
