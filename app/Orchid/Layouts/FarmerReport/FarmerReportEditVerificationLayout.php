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
        $verifier = $this->query->get('farmerReport.verified_by');

        $hasVerifier = ! is_null($verifier);

        return [
            Select::make('farmerReport.status_id')
                ->fromModel(FarmerReportStatus::class, 'name')
                ->title(__('Verification Status'))
                ->required(),

            Relation::make('farmerReport.verified_by')
                ->fromModel(ManagementUser::class, 'name')
                ->applyScope('')
                ->displayAppend('fullNameWithRole')
                ->required()
                ->help(__('The big brother or administrator who verified this farming report'))
                ->title(__('Verified by'))
                ->placeholder(__('Verified by'))
                ->canSee($hasVerifier)
                ->disabled(),
        ];
    }
}
