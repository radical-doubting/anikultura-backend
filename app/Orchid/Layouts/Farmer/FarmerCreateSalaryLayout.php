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
use Orchid\Screen\Fields\Radio;

class FarmerCreateSalaryLayout extends Rows
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
                Select::make('salary_periodicity')
                    ->title('Salary Periodicity:')
                    ->options(["Everyday", "Monthly", "Annually", "Every 15 Days", "Every 3 Months", "Every 6 Months"])
                    ->required(),

                Input::make('estimated_salary')
                    ->title('Estimated Salary:')
                    ->type('number')
                    ->placeholder('15,000')
                    ->required(),
            ]),

            Select::make('social_status')
                ->title('Are your poor?')
                ->options(["Yes", "No"])
                ->required(),

            Input::make('social_status_reason')
                ->title('Why do you think so?')
                ->required(),
        ];
    }
}
