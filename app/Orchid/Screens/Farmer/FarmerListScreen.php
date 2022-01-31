<?php

namespace App\Orchid\Screens\Farmer;

use App\Actions\Farmer\DeleteFarmer;
use App\Actions\Farmer\DeleteFarmerProfile;
use App\Models\Farmer\Farmer;
use App\Models\Farmer\FarmerProfile;
use App\Orchid\Layouts\Farmer\FarmerListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class FarmerListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Farmers';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'List of all farmers under SM KSK SAP';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'farmers' => Farmer::with('profile')
                ->filters()
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
                ->route('platform.farmers.create'),
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
            FarmerListLayout::class,
        ];
    }

    /**
     * Remove a farmer.
     *
     * @param Farmer $farmer
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Farmer $farmer)
    {
        return DeleteFarmer::runOrchidAction($farmer, null);
    }
}
