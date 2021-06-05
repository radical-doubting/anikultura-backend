<?php

namespace App\Orchid\Layouts\Batch;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class AddFarmersLayout extends Rows
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
        return [ Input::make('batches.farmer_names')
        ->type('text')
        ->required()
        ->title(__('Enrolled Farmer'))
        ->placeholder(__('Farmer')),];
        //Select::make('user')
          //  ->fromModel(User::class, 'email');
    }
}
