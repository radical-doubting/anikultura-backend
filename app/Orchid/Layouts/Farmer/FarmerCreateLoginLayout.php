<?php

namespace App\Orchid\Layouts\Farmer;

use App\Models\Farmer\Farmer_profile;
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
                Input::make('username')
                ->title('Username')
                ->placeholder('Username')
                ->help("Please choose a unique username.")
                ->disabled(),

                Input::make('email')
                ->type('email')
                ->title('Email')
                ->placeholder('bootstrap@example.com')
                ->required()
                ->help('Please choose an email you can access.'),

                Password::make('password')
                ->title('Password')
                ->required()
                ->placeholder('Please choose a strong password.'),
            ]),
        ];
    }
}
