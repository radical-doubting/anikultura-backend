<?php

namespace App\Orchid\Layouts\Farmland;

use App\Models\Farmland\CropBuyer;
use App\Models\Farmland\WateringSystem;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layouts\Rows;

class FarmlandEditOtherLayout extends Rows
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
            Relation::make('farmland.wateringSystems.')
                ->fromModel(WateringSystem::class, 'name')
                ->required()
                ->title(__('Watering Systems'))
                ->placeholder(__('Watering Systems'))
                ->multiple(),

            Relation::make('farmland.cropBuyers.')
                ->fromModel(CropBuyer::class, 'name')
                ->required()
                ->title(__('Crop Buyers'))
                ->placeholder(__('Crop Buyers'))
                ->multiple(),
        ];
    }
}
