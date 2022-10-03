<?php

namespace App\Orchid\Layouts\User\BigBrother;

use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Input;

class BigBrotherEditLayout extends AnikulturaEditLayout
{
    protected function fields(): iterable
    {
        return [
            Input::make('bigBrotherProfile.organization_name')
                ->title(__('Affiliated Organization'))
                ->placeholder(__('Affiliated Organization'))
                ->required(),

            Input::make('bigBrotherProfile.age')
                ->title(__('Age'))
                ->type('number')
                ->placeholder(__('Age'))
                ->required(),
        ];
    }
}
