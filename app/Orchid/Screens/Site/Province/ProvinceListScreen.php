<?php

namespace App\Orchid\Screens\Site\Province;

use App\Actions\Site\Province\DeleteProvince;
use App\Helpers\InsightsHelper;
use App\Models\Site\Province;
use App\Orchid\Layouts\Site\Province\ProvinceFiltersLayout;
use App\Orchid\Layouts\Site\Province\ProvinceListLayout;
use App\Orchid\Screens\AnikulturaListScreen;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;

class ProvinceListScreen extends AnikulturaListScreen
{
    public function name(): string
    {
        return __('Provinces');
    }

    public function query(): array
    {
        $this->authorize('viewAny', Province::class);

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
            InsightsHelper::makeLink('site'),
        ];
    }

    public function layout(): array
    {
        return [
            ProvinceFiltersLayout::class,
            ProvinceListLayout::class,
        ];
    }

    public function remove(Province $province, Request $request): RedirectResponse
    {
        return DeleteProvince::runOrchidAction($province, $request);
    }
}
