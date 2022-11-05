<?php

namespace App\Orchid\Screens\Farmland;

use App\Actions\Farmland\DeleteFarmland;
use App\Helpers\InsightsHelper;
use App\Models\Farmland\Farmland;
use App\Orchid\Layouts\Farmland\FarmlandFiltersLayout;
use App\Orchid\Layouts\Farmland\FarmlandListLayout;
use App\Orchid\Screens\AnikulturaListScreen;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Actions\Link;

class FarmlandListScreen extends AnikulturaListScreen
{
    public function name(): string
    {
        return __('Farmlands');
    }

    public function query(): array
    {
        /**
         * @var User
         */
        $user = auth()->user();

        $query = Farmland::query();

        if ($user->cannot('viewAny', Farmland::class)) {
            $query = $query->ofBigBrother($user);
        }

        return [
            'farmlands' => $query
                ->filters()
                ->filtersApplySelection(FarmlandFiltersLayout::class)
                ->defaultSort('id')
                ->paginate(),
        ];
    }

    public function commandBar(): array
    {
        return [
            Link::make(__('Add'))
                ->icon('plus')
                ->route('platform.farmlands.create'),
            InsightsHelper::makeLink('farmland'),
        ];
    }

    public function layout(): array
    {
        return [
            FarmlandFiltersLayout::class,
            FarmlandListLayout::class,
        ];
    }

    public function remove(Farmland $farmland): RedirectResponse
    {
        return DeleteFarmland::runOrchidAction($farmland, null);
    }
}
