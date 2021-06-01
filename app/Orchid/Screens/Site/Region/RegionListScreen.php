<?php

namespace App\Orchid\Screens\Site\Region;

use Orchid\Screen\Screen;

class RegionListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'RegionListScreen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'RegionListScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [];
    }
}
