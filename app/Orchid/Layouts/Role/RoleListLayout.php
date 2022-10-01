<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Role;

use App\Orchid\Layouts\AnikulturaListLayout;
use App\Models\User\Role;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\TD;

class RoleListLayout extends AnikulturaListLayout
{
    public $target = 'roles';

    public function columns(): iterable
    {
        return [
            TD::make('name', __('Name'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Role $role) {
                    return Link::make($role->name)
                        ->route('platform.systems.roles.edit', [$role->id]);
                }),

            TD::make('slug', __('Slug'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT),

            TD::make('created_at', __('Created'))
                ->sort()
                ->render(function (Role $role) {
                    return $role->created_at->toDateTimeString();
                }),
        ];
    }
}
