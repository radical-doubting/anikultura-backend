<?php

namespace App\Orchid\Layouts\Batch;

use App\Models\Batch\Farmers;
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
        Relation::make('batches.farmer_names')
            ->fromModel(Farmers::class, 'name')
            ->required()
            ->multiple()
            ->title('Farmers')
            ->placeholder(__('Farmers')),
        ];
    }
}
