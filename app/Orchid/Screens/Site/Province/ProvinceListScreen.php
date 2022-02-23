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
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Provinces';

    /**
     * Query data.
     *
     * @return array
     */
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
                ->route('platform.sites.provinces.create'),
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
            ProvinceFiltersLayout::class,
            ProvinceListLayout::class,
        ];
    }

    /**
     * Remove a province.
     *
     * @param Province $province
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Province $province)
    {
        return DeleteProvince::runOrchidAction($province, null);
    }
}
