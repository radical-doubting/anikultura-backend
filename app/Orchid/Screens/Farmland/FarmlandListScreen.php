<?php

namespace App\Orchid\Screens\Farmland;

use App\Actions\Farmland\DeleteFarmland;
use App\Models\Farmland\Farmland;
use App\Orchid\Layouts\Farmland\FarmlandFiltersLayout;
use App\Orchid\Layouts\Farmland\FarmlandListLayout;
use App\Orchid\Screens\AnikulturaListScreen;
use Orchid\Screen\Actions\Link;

class FarmlandListScreen extends AnikulturaListScreen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Farmlands';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'farmlands' => Farmland::filters()
                ->filtersApplySelection(FarmlandFiltersLayout::class)
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
                ->route('platform.farmlands.create'),
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
            FarmlandFiltersLayout::class,
            FarmlandListLayout::class,
        ];
    }

    /**
     * Remove a farmland.
     *
     * @param  Farmland  $farmland
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function remove(Farmland $farmland)
    {
        return DeleteFarmland::runOrchidAction($farmland, null);
    }
}
