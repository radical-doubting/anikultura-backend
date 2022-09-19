<?php

namespace App\Orchid\Layouts\Crop;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class CropEditGrowthLayout extends Rows
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
            Input::make('crop.yield_per_ha')
                ->type('text')
                ->max(255)
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
