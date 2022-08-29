<?php

namespace App\Orchid\Screens\Site\Region;

use App\Actions\Site\Region\DeleteRegion;
use App\Models\Site\Region;
use App\Orchid\Layouts\Site\Region\RegionListLayout;
use App\Orchid\Screens\AnikulturaListScreen;
use Orchid\Screen\Actions\Link;

class RegionListScreen extends AnikulturaListScreen
{
    public function name(): ?string
    {
        return __('Regions');
    }

    public function query(): array
    {
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
        ];
    }

    public function layout(): array
    {
        return [
            RegionListLayout::class,
        ];
    }

    /**
     * Remove a region.
     *
     * @param  Region  $region
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function remove(Region $region)
    {
        return DeleteRegion::runOrchidAction($region, null);
    }
}
