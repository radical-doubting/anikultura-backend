<?php

namespace App\Orchid\Screens\Farmer;

use App\Orchid\Layouts\Farmer\FarmerListLayout;
use App\Models\Farmer_profile;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;

class FarmerListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Farmer Profile';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = "View all farmers in SM KSK SAP";

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'farmer_profile' => farmer_profile::all()
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
                ->route('platform.farmer.profile.create'),
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
            FarmerListLayout::class
        ];
    }
}
