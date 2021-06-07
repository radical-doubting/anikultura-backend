<?php

namespace App\Orchid\Screens\Site\Region;

use App\Models\Site\Region;
use App\Orchid\Layouts\Site\Region\RegionListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class RegionListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Regions';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'List of all regions under SM KSK SAP';

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
                ->paginate()
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
            RegionListLayout::class
        ];
    }

    /**
     * @param Region $region
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Region $region)
    {
        $region->delete();

        Toast::info(__('Region was removed successfully'));

        return redirect()->route('platform.sites.regions');
    }
}
