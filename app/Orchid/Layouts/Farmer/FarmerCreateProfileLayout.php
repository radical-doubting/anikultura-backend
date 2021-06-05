<?php

namespace App\Orchid\Layouts\Farmer;

use App\Models\Farmer_profile;
use Orchid\Screen\Field;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Group;

class FarmerCreateProfileLayout extends Rows
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
                Select::make('farmer_profile.gender')
                    ->title('Gender')
                    ->required()
                    ->options(["Male", "Female", "I'd rather not say."]),

                Select::make('farmer_profile.civil_status')
                    ->title('Civil Status')
                    ->required()
                    ->options(["Single", "Married", "Widow", "Annuled", "Separated"]),
            ]),

            Group::make([
                Input::make('farmer_profile.birthday')
                ->type('date')
                ->title('Birthdate')
                ->required()
                ->value('2011-08-19'),

                Input::make('farmer_profile.age')
                ->type('number')
                ->title('Age')
                ->value(42)
                ->disabled(),
            ]),

            Group::make([
                Input::make('farmer_profile.quantity_family_members')
                ->type('number')
                ->title('Number of Family Members')
                ->required()
                ->value(3),
                
                Input::make('farmer_profile.quantity_dependents')
                    ->type('number')
                    ->title('Number of Dependents')
                    ->required()
                    ->value(2),
            ]),

            Input::make('farmer_profile.quantity_working_dependents')
            ->type('number')
            ->title('Number of Working Dependents')
            ->required()
            ->value(2),
        ];
    }
}
