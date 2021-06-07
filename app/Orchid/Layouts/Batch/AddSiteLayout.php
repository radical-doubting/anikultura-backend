<?php

namespace App\Orchid\Layouts\Batch;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class AddSiteLayout extends Rows
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
            /*
            Input::make('batches.region')
            ->type('text')
            ->max(255)
            ->required()
            ->title(__('Region'))
            ->placeholder(__('Region')),

            Input::make('batches.municity')
            ->type('text')
            ->max(255)
            ->required()
            ->title(__('Municipality/City'))
            ->placeholder(__('Municity')),

            Input::make('batches.barangay')
            ->type('text')
            ->max(255)
            ->required()
            ->title(__('Barangay'))
            ->placeholder(__('Barangay')),*/
        ];
    }
}
