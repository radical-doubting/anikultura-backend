<?php

namespace App\Orchid\Layouts\Farmer;

use App\Models\Farmer\FarmerProfile;
use Orchid\Screen\Field;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Password;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Group;

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
        return [
            Group::make([
                Input::make('user.first_name')
                    ->title('First Name')
                    ->placeholder('Enter first name')
                    ->required(),

                Input::make('user.middle_name')
                    ->title('Middle Name')
                    ->placeholder('Enter middle name'),

                Input::make('user.last_name')
                    ->title('Last Name')
                    ->placeholder('Enter Last name')
                    ->required(),
            ]),

            Group::make([
                Input::make('user.name')
                    ->title('Username')
                    ->placeholder('Username')
                    ->required(),

                Password::make('password')
                    ->title('Password')
                    ->required(),
            ]),

            Group::make([
                Input::make('user.email')
                    ->type('email')
                    ->title('Email')
                    ->placeholder('email@example.com'),

                Input::make('user.contact_number')
                    ->placeholder('09123456789')
                    ->title('Mobile Number'),
            ]),
        ];
    }
}
