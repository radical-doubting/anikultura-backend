<?php

namespace App\Orchid\Layouts\Crop;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class CropEditBasicLayout extends Rows
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
            Input::make('crop.name')
                ->type('text')
                ->required()
                ->title(__('Crop Name'))
                ->placeholder(__('Name')),

            Input::make('crop.group')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Croup Group'))
                ->placeholder(__('Group')),

            Input::make('crop.variety')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Crop Variety'))
                ->placeholder(__('Variety')),
        ];
    }
}
