<?php

namespace App\Orchid\Layouts\FarmerReport;

use App\Models\User\ManagementUser;
use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Relation;

class FarmerReportEditVerificationLayout extends AnikulturaEditLayout
{
    protected function fields(): iterable
    {
        return [
            CheckBox::make('farmerReport.verified')
                ->required()
                ->sendTrueOrFalse()
                ->title(__('Verification Status'))
                ->placeholder(__('This farmer report is considered as valid')),

            Relation::make('farmerReport.verified_by')
                ->fromModel(ManagementUser::class, 'name')
                ->searchColumns('first_name', 'last_name')
                ->displayAppend('fullNameWithRole')
                ->required()
                ->help(__('The big brother or administrator who verified this farming report'))
                ->title(__('Verified by'))
                ->placeholder(__('Verified by')),
        ];
    }
}
