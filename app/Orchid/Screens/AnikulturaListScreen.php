<?php

namespace App\Orchid\Screens;

use Illuminate\Support\Facades\Config;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;

abstract class AnikulturaListScreen extends Screen
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $screenName = strtolower($this->name());
            $programName = Config::get('anikultura.programFullName');

            $this->description = (__('A list of all ')).$screenName.(__(' under the ')).$programName;

            return $next($request);
        });
    }

    /**
     * Views.
     *
     * @return Layout[]|array<int, string>
     */
    abstract public function layout(): array;
}
