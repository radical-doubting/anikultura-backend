<?php

namespace App\Orchid\Screens\Farmland;

use Orchid\Screen\Screen;

class FarmlandListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'FarmlandListScreen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'FarmlandListScreen';

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
