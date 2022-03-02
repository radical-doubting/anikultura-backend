<?php

namespace App\Orchid\Layouts\FarmerReport;

use App\Models\ManagementUser;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layouts\Rows;

class FarmerReportEditVerificationLayout extends Rows
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
            CheckBox::make('farmer_report.verified')
                ->required()
                ->sendTrueOrFalse()
                ->title(__('Verification Status'))
                ->placeholder(__('This farmer report is considered as valid')),

            Relation::make('farmer_report.verified_by')
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
