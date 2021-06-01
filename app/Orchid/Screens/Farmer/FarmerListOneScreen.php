<?php

namespace App\Orchid\Screens\Farmer;

use App\Orchid\Layouts\Farmer\FarmerListOneLayout;
use App\Models\Farmer\Farmer_profile;
use Orchid\Screen\Screen;
use Orchid\Screen\Layouts\Link;

class FarmerListOneScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'View Farmer';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'View only one farmer.';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'farmer_profile' => farmer_profile::where('lastname', $lastname)->firstorFail()
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
            FarmerListOneLayout::class
        ];
    }
}
