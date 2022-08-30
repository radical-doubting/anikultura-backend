<?php

namespace App\Orchid\Screens\Site\Municity;

use App\Actions\Site\Municity\DeleteMunicity;
use App\Models\Site\Municity;
use App\Orchid\Layouts\Site\Municity\MunicityFiltersLayout;
use App\Orchid\Layouts\Site\Municity\MunicityListLayout;
use App\Orchid\Screens\AnikulturaListScreen;
use Orchid\Screen\Actions\Link;

class MunicityListScreen extends AnikulturaListScreen
{
    public function name(): string
    {
        return __('Municipalities and Cities');
    }

    public function query(): array
    {
        return [
            'municities' => Municity::with('region')
                ->with('province')
                ->filters()
                ->filtersApplySelection(MunicityFiltersLayout::class)
                ->defaultSort('id')
                ->paginate(),
        ];
    }

    public function commandBar(): array
    {
        return [
            Link::make(__('Add'))
                ->icon('plus')
                ->route('platform.sites.municities.create'),
        ];
    }

    public function layout(): array
    {
        return [
            MunicityFiltersLayout::class,
            MunicityListLayout::class,
        ];
    }

    /**
     * Remove a municity.
     * 
     * @param  Municity  $municity
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function remove(Municity $municity)
    {
        return DeleteMunicity::runOrchidAction($municity, null);
    }
}
