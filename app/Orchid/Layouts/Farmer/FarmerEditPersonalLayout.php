<?php

namespace App\Orchid\Layouts\Farmer;

use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;

class FarmerEditPersonalLayout extends AnikulturaEditLayout
{
    protected function fields(): iterable
    {
        return [
            Group::make([
                Select::make('farmer_profile.gender')
                    ->title(__('Gender'))
                    ->required()
                    ->options(['Male', 'Female', "I'd rather not say."]),

                Select::make('farmer_profile.civil_status')
                    ->title(__('Civil Status'))
                    ->required()
                    ->options(['Single', 'Married', 'Widow', 'Annuled', 'Separated']),
            ]),

            Group::make([
                Input::make('farmer_profile.birthday')
                    ->type('date')
                    ->title(__('Birthdate'))
                    ->placeholder(__('Birthdate'))
                    ->required(),

                Input::make('farmer_profile.age')
                    ->type('number')
                    ->title(__('Age'))
                    ->placeholder(__('Age'))
                    ->required(),
            ]),

            Group::make([
                Input::make('farmer_profile.quantity_family_members')
                    ->type('number')
                    ->title(__('Number of Family Members'))
                    ->placeholder(__('Number of Family Members'))
                    ->required(),

                Input::make('farmer_profile.quantity_dependents')
                    ->type('number')
                    ->title(__('Number of Dependents'))
                    ->placeholder(__('Number of Dependents'))
                    ->required(),

                Input::make('farmer_profile.quantity_working_dependents')
                    ->type('number')
                    ->title(__('Number of Working Dependents'))
                    ->placeholder(__('Number of Working Dependents'))
                    ->required(),
            ]),

        ];
    }
}
