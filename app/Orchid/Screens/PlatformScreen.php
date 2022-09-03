<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class PlatformScreen extends Screen
{
    public function __construct()
    {
    }

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $user = auth('web')->user();
        $firstName = $user->first_name;
        $roles = $user->roles->pluck('name')->implode(' / ');

        $this->name = (__('Greetings, ')) . $firstName . "!";
        $this->description = (__('Welcome to the Anikultura Management Dashboard - ')) . $roles;

        return [];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make(__('Documentation'))
                ->href('https://orchid.software/en/docs')
                ->icon('docs'),

            Link::make(__('GitHub'))
                ->href('https://github.com/Radical-Doubting')
                ->icon('social-github'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): array
    {
        return [
            Layout::view('platform::partials.welcome'),
        ];
    }
}
