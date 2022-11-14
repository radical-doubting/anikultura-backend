<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Home;

use App\Models\User\User;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class HomeScreen extends Screen
{
    public User $user;

    public function name(): string
    {
        return __('Greetings, ').$this->user->first_name.'!';
    }

    public function description(): string
    {
        $roles = $this->user->roles->pluck('name')->implode(' / ');

        return __('Welcome to the Anikultura Management Dashboard - ').$roles;
    }

    public function query(): array
    {
        return [
            'user' => auth('web')->user(),
        ];
    }

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

    public function layout(): iterable
    {
        return [
            Layout::view('platform::partials.welcome'),
        ];
    }
}
