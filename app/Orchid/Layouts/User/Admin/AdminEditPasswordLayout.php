<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User\Admin;

use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Password;

class AdminEditPasswordLayout extends AnikulturaEditLayout
{
    public function fields(): iterable
    {
        $admin = $this->query->get('admin');

        $placeholder = $admin->exists
            ? __('Leave empty to keep current password')
            : __('Enter the password to be set');

        return [
            Password::make('admin.password')
                ->placeholder($placeholder)
                ->required(! $admin->exists)
                ->title(__('Password')),
        ];
    }
}
