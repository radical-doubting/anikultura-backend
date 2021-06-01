<?php

namespace App\Orchid\Screens\Site\Municity;

use App\Models\Site\Municity;
use App\Orchid\Layouts\Site\Municity\MunicityListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class MunicityListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Municities';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'List of all municities under SM KSK SAP';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'municities' => Municity::with('region')
                ->with('province')
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
                ->route('platform.sites.municities.create'),
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
            MunicityListLayout::class
        ];
    }
}
