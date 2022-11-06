<?php

namespace App\Orchid\Screens\User\Farmer;

use App\Actions\User\Farmer\DeleteFarmer;
use App\Helpers\InsightsHelper;
use App\Models\User\Farmer\Farmer;
use App\Models\User\User;
use App\Orchid\Layouts\User\Farmer\FarmerFiltersLayout;
use App\Orchid\Layouts\User\Farmer\FarmerListLayout;
use App\Orchid\Screens\AnikulturaListScreen;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;

class FarmerListScreen extends AnikulturaListScreen
{
    public function name(): string
    {
        return __('Farmers');
    }

    public function query(): array
    {
        /**
         * @var User
         */
        $user = auth()->user();

        $query = Farmer::query();

        if ($user->cannot('viewAny', Farmer::class)) {
            $query = $query->ofBigBrother($user);
        }

        return [
            'farmers' => $query
                ->filters()
                ->filtersApplySelection(FarmerFiltersLayout::class)
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
            InsightsHelper::makeLink('farmer'),
        ];
    }

    public function layout(): array
    {
        return [
            FarmerFiltersLayout::class,
            FarmerListLayout::class,
        ];
    }

    public function remove(Farmer $farmer, Request $request): RedirectResponse
    {
        return DeleteFarmer::runOrchidAction($farmer, $request);
    }
}
