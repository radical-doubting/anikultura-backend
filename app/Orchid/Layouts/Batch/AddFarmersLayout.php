<?php

namespace App\Orchid\Layouts\Batch;

use App\Models\Batch\Farmers;
use App\Models\User;
use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Relation;

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
        return [ 

        Relation::make('batches.farmers.')
            ->fromModel(User::class, 'name')
            ->applyScope('farmer')
            ->searchColumns('first_name', 'last_name')
            ->displayAppend('full_name')
            ->required()
            ->multiple()
            ->help(__('Search the name of this farmland\'s members'))
            ->title(__('Farmers'))
            ->placeholder(__('Farmers')),
        ];
    }
}
