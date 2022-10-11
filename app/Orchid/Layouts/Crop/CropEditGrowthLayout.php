<?php

namespace App\Orchid\Layouts\Crop;

use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;

class CropEditGrowthLayout extends AnikulturaEditLayout
{
    protected function fields(): iterable
    {
        return [
            Input::make('crop.yield_per_ha')
                ->type('text')
                ->required()
                ->title(__('Yield per Hectare (kg/ha)'))
                ->placeholder(__('Yield per Hectare (kg/ha)')),
            Group::make([
                Input::make('crop.maturity_lower_bound')
                    ->type('number')
                    ->required()
                    ->title(__('Maturity Lower Bound (DAP, DAT, DAS)'))
                    ->placeholder(__('(DAP, DAT, DAS)')),
                Input::make('crop.maturity_upper_bound')
                    ->type('number')
                    ->required()
                    ->title(__('Maturity Upper Bound (DAP, DAT, DAS)'))
                    ->placeholder(__('(DAP, DAT, DAS)')),
            ]),
        ];
    }
}
