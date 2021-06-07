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

class FarmerCreateLoginLayout extends Rows
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
                Input::make('lastname')
                    ->title('Last Name:')
                    ->placeholder('Enter Last name')
                    ->required(),

                Input::make('firstname')
                    ->title('First Name:')
                    ->placeholder('Enter first name')
                    ->required(),

                Input::make('middlename')
                    ->title('Middle Name:')
                    ->placeholder('Enter middle name')
                    ->required(),
            ]),

            Group::make([
                Input::make('username')
                    ->title('Username')
                    ->placeholder('Username')
                    ->disabled(),

                Input::make('email')
                    ->type('email')
                    ->title('Email')
                    ->placeholder('bootstrap@example.com')
                    ->required(),

                Password::make('password')
                    ->title('Password')
                    ->required(),
            ]),

            Input::make('contact_number')
                ->type('number')
                ->placeholder('09123456789')
                ->required()
                ->title('Mobile Number'),
        ];
    }
}
