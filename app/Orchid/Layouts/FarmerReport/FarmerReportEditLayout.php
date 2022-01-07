<?php

namespace App\Orchid\Layouts\FarmerReport;

use App\Models\Crop\Crop;
use App\Models\Farmland\Farmland;
use App\Models\Crop\SeedStage;
use App\Models\User;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layouts\Rows;

class FarmerReportEditLayout extends Rows
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
            Relation::make('farmer_report.farmer_id')
                ->fromModel(User::class, 'name')
                ->applyScope('farmer')
                ->searchColumns('first_name', 'last_name')
                ->displayAppend('full_name')
                ->required()
                ->help(__('Search the name of this report\'s owner'))
                ->title(__('Farmer'))
                ->placeholder(__('Farmer')),

            Relation::make('farmer_report.farmland_id')
                ->fromModel(Farmland::class, 'id')
                ->required()
                ->title(__('Farmland'))
                ->placeholder(__('Farmland')),

            Relation::make('farmer_report.crop_id')
                ->fromModel(Crop::class, 'name')
                ->required()
                ->title(__('Crop'))
                ->placeholder(__('Crop')),

            Relation::make('farmer_report.seed_stage_id')
                ->fromModel(SeedStage::class, 'name')
                ->required()
                ->title(__('Seed Stage'))
                ->placeholder(__('Seed Stage')),

            Input::make('farmer_report.volume')
                ->type('number')
                ->max(255)
                ->required()
                ->title(__('Volume (kg)'))
                ->placeholder(__('Volume (kg)')),
        ];
    }
}
