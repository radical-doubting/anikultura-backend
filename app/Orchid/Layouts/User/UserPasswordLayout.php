<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Platform\Models\User;
use Orchid\Screen\Fields\Password;

class UserPasswordLayout extends AnikulturaEditLayout
{
    public function fields(): iterable
    {
        /** @var User $user */
        $user = $this->query->get('user');
        $placeholder = $user->exists
            ? __('Leave empty to keep current password')
            : __('Enter the password to be set');

        return [
            Password::make('user.password')
                ->placeholder($placeholder)
                ->required(! $user->exists)
                ->title(__('Password')),
        ];
    }
}
