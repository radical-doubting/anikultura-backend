<?php

namespace App\Orchid\Layouts\Farmland;

use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;

class FarmlandCreateFarmLayout extends Rows
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
            Select::make('farm_type')
                ->title('Farm Type:')
                ->required()
                ->options(["Personal Farmland", "Community Farmland"]),
    
            Input::make('firstname')
                ->type('number')
                ->required()
                ->title('Farm Size:'),

            Input::make('watering_system_used')
                ->title('Watering System Used:')
                ->placeholder('-')
                ->required(),
            
            Input::make('crop_buyer')
            ->title('Usual Crop Buyers:')
            ->placeholder('-')
            ->required(),
        ];
    }
}
