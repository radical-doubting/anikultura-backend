<?php

namespace App\Orchid\Layouts\User\Farmer;

use App\Models\User\Farmer\SalaryPeriodicity;
use App\Models\User\Farmer\SocialStatus;
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
                Select::make('farmerProfile.salary_periodicity_id')
                    ->fromModel(SalaryPeriodicity::class, 'name')
                    ->title(__('Salary Periodicity'))
                    ->required(),

                Input::make('farmerProfile.estimated_salary')
                    ->title('Estimated Salary')
                    ->type('number')
                    ->placeholder(__('PHP'))
                    ->required(),
            ]),

            Select::make('farmerProfile.social_status_id')
                ->fromModel(SocialStatus::class, 'name')
                ->title(__('Social Status'))
                ->required(),

            TextArea::make('farmerProfile.social_status_reason')
                ->title(__('Social Status Reason'))
                ->help(__('Why do you think the farmer has this social status?')),
        ];
    }
}
