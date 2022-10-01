<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use App\Orchid\Layouts\AnikulturaEditLayout;
use App\Models\User\Role;
use Orchid\Screen\Fields\Select;

class UserRoleLayout extends AnikulturaEditLayout
{
    public function fields(): iterable
    {
        return [
            Select::make('user.roles.')
                ->fromModel(Role::class, 'name')
                ->multiple()
                ->title(__('Name role'))
                ->help('Specify which groups this account should belong to'),
        ];
    }
}
