<?php

namespace App\Orchid\Screens\Farmer;

use App\Actions\Farmer\DeleteFarmer;
use App\Models\Farmer\Farmer;
use App\Orchid\Layouts\Farmer\FarmerListLayout;
use App\Orchid\Screens\AnikulturaListScreen;
use Orchid\Screen\Actions\Link;

class FarmerListScreen extends AnikulturaListScreen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Farmers';

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
