<?php

namespace App\Orchid\Screens\User\Farmer;

use App\Actions\User\Farmer\DeleteFarmer;
use App\Models\User\Farmer\Farmer;
use App\Orchid\Layouts\Farmer\FarmerListLayout;
use App\Orchid\Screens\AnikulturaListScreen;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Actions\Link;

class FarmerListScreen extends AnikulturaListScreen
{
    public function name(): string
    {
        return __('Farmers');
    }

    public function query(): array
    {
        return [
            'farmers' => Farmer::with('profile')
                ->filters()
                ->defaultSort('id')
                ->paginate(),
        ];
    }

    public function commandBar(): array
    {
        return [
            Link::make(__('Add'))
                ->icon('plus')
                ->route('platform.farmers.create'),
        ];
    }

    public function layout(): array
    {
        return [
            FarmerListLayout::class,
        ];
    }

    public function remove(Farmer $farmer): RedirectResponse
    {
        return DeleteFarmer::runOrchidAction($farmer, null);
    }
}
