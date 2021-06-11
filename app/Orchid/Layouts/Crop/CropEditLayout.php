<?php

namespace App\Orchid\Layouts\Crop;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class CropEditLayout extends Rows
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
            Input::make('crop.group')
            ->type('text')
            ->max(255)
            ->required()
            ->title(__('Croup Group'))
            ->placeholder(__('Group')),

            Input::make('crop.name')
            ->type('text')
            ->required()
            ->title(__('Crop Name'))
            ->placeholder(__('Name')),

            Input::make('crop.variety')
            ->type('text')
            ->max(255)
            ->required()
            ->title(__('Crop Variety'))
            ->placeholder(__('Variety')),

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
        ];
        
    }
}
