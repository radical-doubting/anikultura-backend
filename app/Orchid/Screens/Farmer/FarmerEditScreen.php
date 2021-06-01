<?php

namespace App\Orchid\Screens\Farmer;

use App\Orchid\Layouts\Farmer\FarmerEditLayout;
use App\Models\Farmer\Farmer_profile;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;

class FarmerEditScreen extends Screen
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
    public $description = "Edit farmer's profile in SM KSK SAP";

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make(__('Edit'))
                ->icon('plus')
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [];
    }
}
