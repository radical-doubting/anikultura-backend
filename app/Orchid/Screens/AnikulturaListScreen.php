<?php

namespace App\Orchid\Screens;

use Illuminate\Support\Facades\Config;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;

abstract class AnikulturaListScreen extends Screen
{
    public function description(): string
    {
        $screenName = strtolower($this->name());
        $programName = Config::get('anikultura.programFullName');

        return __('A list of all ').$screenName.(__(' under the ')).$programName;
    }

    /**
     * @return string[]|Layout[]
     */
    abstract public function layout(): iterable;
}
