<?php

namespace App\Orchid\Screens\Site\Region;

use App\Actions\Site\Region\DeleteRegion;
use App\Helpers\InsightsHelper;
use App\Models\Site\Region;
use App\Orchid\Layouts\Site\Region\RegionListLayout;
use App\Orchid\Screens\AnikulturaListScreen;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Actions\Link;

class RegionListScreen extends AnikulturaListScreen
{
    public function name(): string
    {
        return __('Regions');
    }

    public function query(): array
    {
        $this->authorize('viewAny', Region::class);

        return [
            'regions' => Region::filters()
                ->defaultSort('id')
                ->paginate(),
        ];
    }

    public function commandBar(): array
    {
        return [
            Link::make(__('Add'))
                ->icon('plus')
                ->route('platform.sites.regions.create'),
            InsightsHelper::makeLink('site'),
        ];
    }

    public function layout(): array
    {
        return [
            RegionListLayout::class,
        ];
    }

    public function remove(Region $region): RedirectResponse
    {
        return DeleteRegion::runOrchidAction($region, null);
    }
}
