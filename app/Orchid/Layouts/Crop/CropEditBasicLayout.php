<?php

namespace App\Orchid\Layouts\Crop;

use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Input;

class CropEditBasicLayout extends AnikulturaEditLayout
{
    protected function fields(): iterable
    {
        return [
            Input::make('crop.name')
                ->type('text')
                ->required()
                ->title(__('Crop Name'))
                ->placeholder(__('Name')),

            Input::make('crop.group')
                ->type('text')
                ->required()
                ->title(__('Crop Group'))
                ->placeholder(__('Group')),

            Input::make('crop.variety')
                ->type('text')
                ->required()
                ->title(__('Crop Variety'))
                ->placeholder(__('Variety')),
        ];
    }
}
