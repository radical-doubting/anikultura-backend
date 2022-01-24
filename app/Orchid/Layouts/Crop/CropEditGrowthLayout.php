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
            Group::make([
                Input::make('crop.establishment_days')
                    ->type('number')
                    ->required()
                    ->title(__('Crop Establishment Days'))
                    ->placeholder(__('Days')),
                Input::make('crop.vegetative_days')
                    ->type('number')
                    ->required()
                    ->title(__('Crop Vegetative Days'))
                    ->placeholder(__('Days')),
            ]),

            Group::make([
                Input::make('crop.yield_formation_days')
                    ->type('number')
                    ->required()
                    ->title(__('Crop Yield Formation Days'))
                    ->placeholder(__('Days')),
                Input::make('crop.ripening_days')
                    ->type('number')
                    ->required()
                    ->title(__('Crop Ripening Days'))
                    ->placeholder(__('Days')),
            ]),
        ];
    }
}
