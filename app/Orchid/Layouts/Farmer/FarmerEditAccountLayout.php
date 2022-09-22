<?php

namespace App\Orchid\Layouts\Farmer;

use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Password;

class FarmerEditAccountLayout extends AnikulturaEditLayout
{
    protected function fields(): iterable
    {
        $farmer = $this->query->get('farmer');
        $hasFarmer = is_null($farmer) ? false : $farmer->exists;

        $passwordPlaceholder = $hasFarmer
            ? __('Leave empty to keep current password')
            : __('Enter the password to be set');

        return [
            Group::make([
                Input::make('farmer.first_name')
                    ->title(__('First Name'))
                    ->placeholder(__('First Name'))
                    ->required(),

                Input::make('farmer.middle_name')
                    ->title(__('Middle Name'))
                    ->placeholder(__('Middle Name')),

                Input::make('farmer.last_name')
                    ->title(__('Last Name'))
                    ->placeholder(__('Last name'))
                    ->required(),
            ]),

            Group::make([
                Input::make('farmer.name')
                    ->title(__('Username'))
                    ->placeholder(__('Username'))
                    ->required(),

                Password::make('farmer.password')
                    ->title(__('Password'))
                    ->placeholder($passwordPlaceholder)
                    ->required(! $hasFarmer),
            ]),

            Group::make([
                Input::make('farmer.email')
                    ->type('email')
                    ->title(__('Email'))
                    ->placeholder('email@example.com'),

                Input::make('farmer.contact_number')
                    ->title(__('Mobile Number'))
                    ->placeholder('09123456789'),
            ]),
        ];
    }
}
