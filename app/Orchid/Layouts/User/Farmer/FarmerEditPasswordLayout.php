<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User\Farmer;

use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Password;

class FarmerEditPasswordLayout extends AnikulturaEditLayout
{
    public function fields(): iterable
    {
        $farmer = $this->query->get('farmer');

        $placeholder = $farmer->exists
            ? __('Leave empty to keep current password')
            : __('Enter the password to be set');

        return [
            Password::make('farmer.password')
                ->placeholder($placeholder)
                ->required(! $farmer->exists)
                ->title(__('Password')),
        ];
    }
}
