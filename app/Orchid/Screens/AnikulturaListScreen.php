<?php

namespace App\Orchid\Screens;

use Illuminate\Support\Facades\Config;
use Orchid\Screen\Screen;

abstract class AnikulturaListScreen extends Screen
{
    public function __construct()
    {
        $screenName = strtolower($this->name);
        $programName = Config::get('anikultura.programFullName');

        $this->description = "A list of all $screenName under the $programName";
    }

    abstract public function layout(): array;
}
