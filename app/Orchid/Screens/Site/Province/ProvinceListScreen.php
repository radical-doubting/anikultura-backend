<?php

namespace App\Orchid\Screens\Site\Province;

use App\Actions\Site\Province\DeleteProvince;
use App\Models\Site\Province;
use App\Orchid\Layouts\Site\Province\ProvinceFiltersLayout;
use App\Orchid\Layouts\Site\Province\ProvinceListLayout;
use App\Orchid\Screens\AnikulturaListScreen;
use Orchid\Screen\Actions\Link;

class ProvinceListScreen extends AnikulturaListScreen
{
    public function name(): string
    {
        return __('Provinces');
    }

    public function query(): array
    {
        return [
            'provinces' => Province::with('region')
                ->filters()
                ->filtersApplySelection(ProvinceFiltersLayout::class)
                ->defaultSort('id')
                ->paginate(),
        ];
    }

    public function commandBar(): array
    {
        return [
            Link::make(__('Add'))
                ->icon('plus')
                ->route('platform.sites.provinces.create'),
        ];
    }

    public function layout(): array
    {
        return [
            ProvinceFiltersLayout::class,
            ProvinceListLayout::class,
        ];
    }

    /**
     * Remove a province.
     *
     * @param  Province  $province
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function remove(Province $province)
    {
        return DeleteProvince::runOrchidAction($province, null);
    }
}
