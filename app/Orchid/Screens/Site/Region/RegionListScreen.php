<?php

namespace App\Orchid\Screens\Site\Region;

use App\Actions\Site\Region\DeleteRegion;
use App\Models\Site\Region;
use App\Orchid\Layouts\Site\Region\RegionListLayout;
use App\Orchid\Screens\AnikulturaListScreen;
use Orchid\Screen\Actions\Link;

class RegionListScreen extends AnikulturaListScreen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Regions';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'regions' => Region::filters()
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
                ->route('platform.sites.regions.create'),
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
            RegionListLayout::class,
        ];
    }

    /**
     * Remove a region.
     *
     * @param Region $region
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Region $region)
    {
        return DeleteRegion::runOrchidAction($region, null);
    }
}
