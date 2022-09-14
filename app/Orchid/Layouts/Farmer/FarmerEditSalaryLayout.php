<?php

namespace App\Orchid\Layouts\Farmer;

use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;

class FarmerEditSalaryLayout extends AnikulturaEditLayout
{
    protected function fields(): iterable
    {
        return [
            Group::make([
                Select::make('farmerProfile.salary_periodicity')
                    ->title('Salary Periodicity')
                    ->options(['Everyday', 'Monthly', 'Annually', 'Every 15 Days', 'Every 3 Months', 'Every 6 Months'])
                    ->required(),

                Input::make('farmerProfile.estimated_salary')
                    ->title('Estimated Salary')
                    ->type('number')
                    ->placeholder(__('PHP'))
                    ->required(),
            ]),

            Select::make('farmerProfile.social_status')
                ->title('Is the farmer poor?')
                ->options(['Yes', 'No'])
                ->required(),

            TextArea::make('farmerProfile.social_status_reason')
                ->title('Why do you think so?')
                ->required(),
        ];
    }
}
