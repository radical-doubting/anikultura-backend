<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Role;

use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Input;

class RoleEditLayout extends AnikulturaEditLayout
{
    public function fields(): iterable
    {
        return [
            Input::make('role.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Name'))
                ->placeholder(__('Name'))
                ->help(__('Role display name')),

            Input::make('role.slug')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Slug'))
                ->placeholder(__('Slug'))
                ->help(__('Actual name in the system')),
        ];
    }
}
