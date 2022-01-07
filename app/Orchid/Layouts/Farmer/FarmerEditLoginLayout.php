<?php

namespace App\Orchid\Layouts\Farmer;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Password;
use Orchid\Screen\Layouts\Rows;

class FarmerEditLoginLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
        $user = $this->query->get('user');
        $hasUser = is_null($user) ? false : $user->exists;
        $passwordPlaceholder = $hasUser
            ? __('Leave empty to keep current password')
            : __('Enter the password to be set');

        return [
            Group::make([
                Input::make('user.first_name')
                    ->title(__('First Name'))
                    ->placeholder(__('First Name'))
                    ->required(),

                Input::make('user.middle_name')
                    ->title(__('Middle Name'))
                    ->placeholder(__('Middle Name')),

                Input::make('user.last_name')
                    ->title(__('Last Name'))
                    ->placeholder(__('Last name'))
                    ->required(),
            ]),

            Group::make([
                Input::make('user.name')
                    ->title(__('Username'))
                    ->placeholder(__('Username'))
                    ->required(),

                Password::make('user.password')
                    ->title(__('Password'))
                    ->placeholder($passwordPlaceholder)
                    ->required(!$hasUser),
            ]),

            Group::make([
                Input::make('user.email')
                    ->type('email')
                    ->title(__('Email'))
                    ->placeholder('email@example.com'),

                Input::make('user.contact_number')
                    ->title(__('Mobile Number'))
                    ->placeholder('09123456789'),

            ]),
        ];
    }
}
