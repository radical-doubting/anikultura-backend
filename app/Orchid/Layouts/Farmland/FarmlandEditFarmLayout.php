<?php

namespace App\Orchid\Layouts\Farmland;

use App\Models\Farmland\CropBuyer;
use App\Models\Farmland\FarmlandStatus;
use App\Models\Farmland\FarmlandType;
use App\Models\Farmland\WateringSystem;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layouts\Rows;

class FarmlandEditFarmLayout extends Rows
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
            Relation::make('farmland.type_id')
                ->fromModel(FarmlandType::class, 'name')
                ->required()
                ->title(__('Type'))
                ->placeholder(__('Type')),

            Relation::make('farmland.status_id')
                ->fromModel(FarmlandStatus::class, 'name')
                ->required()
                ->title(__('Status'))
                ->placeholder(__('Status')),

            Input::make('farmland.hectares_size')
                ->type('number')
                ->required()
                ->title(__('Size'))
                ->placeholder(__('Size in hectares')),

            Relation::make('farmland.watering_systems.')
                ->fromModel(WateringSystem::class, 'name')
                ->required()
                ->title(__('Watering Systems Used'))
                ->placeholder(__('Watering Systems Used'))
                ->multiple(),

            Relation::make('farmland.crop_buyers.')
                ->fromModel(CropBuyer::class, 'name')
                ->required()
                ->title(__('Crop Buyers'))
                ->placeholder(__('Crop Buyers'))
                ->multiple(),
        ];
    }
}
