<?php

namespace App\Orchid\Layouts\User\BigBrother;

use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;

class BigBrotherEditAccountLayout extends AnikulturaEditLayout
{
    protected function fields(): iterable
    {
        return [
            Group::make([
                Input::make('bigBrother.first_name')
                    ->title(__('First Name'))
                    ->placeholder(__('First Name'))
                    ->required(),

                Input::make('bigBrother.middle_name')
                    ->title(__('Middle Name'))
                    ->placeholder(__('Middle Name')),

                Input::make('bigBrother.last_name')
                    ->title(__('Last Name'))
                    ->placeholder(__('Last name'))
                    ->required(),
            ]),

            Group::make([
                Input::make('bigBrother.name')
                    ->title(__('Username'))
                    ->placeholder(__('Username'))
                    ->required(),
            ]),

            Group::make([
                Input::make('bigBrother.email')
                    ->type('email')
                    ->title(__('Email'))
                    ->placeholder('email@example.com'),

                Input::make('bigBrother.contact_number')
                    ->title(__('Mobile Number'))
                    ->placeholder('09123456789'),
            ]),
        ];
    }
}
