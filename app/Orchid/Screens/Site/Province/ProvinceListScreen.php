<?php

namespace App\Orchid\Screens\Site\Province;

use App\Models\Site\Province;
use App\Orchid\Layouts\Site\Province\ProvinceListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class ProvinceListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Provinces';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'List of all provinces under SM KSK SAP';

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
            ProvinceListLayout::class
        ];
    }
}
