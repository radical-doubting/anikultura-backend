<?php

namespace App\Orchid\Layouts\User\Admin;

use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Input;

class AdminEditProfileLayout extends AnikulturaEditLayout
{
    protected function fields(): iterable
    {
        return [
            Input::make('adminProfile.age')
                ->title(__('Age'))
                ->type('number')
                ->placeholder(__('Age'))
                ->required(),
        ];
    }
}
