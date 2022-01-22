<?php

namespace App\Orchid\Layouts\Batch;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

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
            Input::make('batch.farmschool_name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Farmschool Name'))
                ->placeholder(__('Farmschool Name')),
        ];
    }
}
