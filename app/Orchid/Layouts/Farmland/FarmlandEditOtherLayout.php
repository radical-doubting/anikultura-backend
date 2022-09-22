<?php

namespace App\Orchid\Layouts\Farmland;

use App\Models\Farmland\CropBuyer;
use App\Models\Farmland\WateringSystem;
use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Relation;

class FarmlandEditOtherLayout extends AnikulturaEditLayout
{
    protected function fields(): iterable
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
