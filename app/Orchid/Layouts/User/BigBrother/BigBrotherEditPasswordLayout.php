<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User\BigBrother;

use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Password;

class BigBrotherEditPasswordLayout extends AnikulturaEditLayout
{
    public function fields(): iterable
    {
        $bigBrother = $this->query->get('bigBrother');

        $placeholder = $bigBrother->exists
            ? __('Leave empty to keep current password')
            : __('Enter the password to be set');

        return [
            Password::make('bigBrother.password')
                ->placeholder($placeholder)
                ->required(! $bigBrother->exists)
                ->title(__('Password')),
        ];
    }
}
