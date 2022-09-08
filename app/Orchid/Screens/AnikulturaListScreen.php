<?php

namespace App\Orchid\Screens;

use Illuminate\Support\Facades\Config;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;

abstract class AnikulturaListScreen extends Screen
{
    public function __construct()
    {
        $screenName = strtolower($this->name());
        $programName = Config::get('anikultura.programFullName');

        $this->description = "A list of all $screenName under the $programName";
    }

    /**
     * Views.
     *
     * @return Layout[]|array<int, string>
     */
    abstract public function layout(): array;
}
