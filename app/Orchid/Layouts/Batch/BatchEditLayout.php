<?php

namespace App\Orchid\Layouts\Batch;

use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;

class BatchEditLayout extends Rows
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
            Input::make('batches.assigned_farmschool_name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Assigned Farmschool Name'))
                ->placeholder(__('Farmschool Name')),

            Input::make('batches.number_seeds_distributed')
                ->type('text')
                ->required()
                ->title(__('Number of Seeds Distributed'))
                ->placeholder(__('100')),

        
        ];
    }
}
