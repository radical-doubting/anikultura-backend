<?php

namespace App\Orchid\Layouts\FarmerReport;

use App\Models\FarmerReport\FarmerReportStatus;
use App\Models\User\ManagementUser;
use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;

class FarmerReportEditVerificationLayout extends AnikulturaEditLayout
{
    protected function fields(): iterable
    {
        return [
            Select::make('farmerReport.status_id')
                ->fromModel(FarmerReportStatus::class, 'name')
                ->title(__('Verification Status'))
                ->placeholder(__('This farmer report is considered as valid'))
                ->required(),

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
