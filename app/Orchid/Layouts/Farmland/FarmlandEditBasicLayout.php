<?php

namespace App\Orchid\Layouts\Farmland;

use App\Models\Farmland\FarmlandStatus;
use App\Models\Farmland\FarmlandType;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layouts\Rows;

class FarmlandEditBasicLayout extends Rows
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
            Input::make('farmland.name')
                ->type('text')
                ->required()
                ->title(__('Name'))
                ->placeholder(__('Name')),

            Group::make([
                Relation::make('farmland.type_id')
                    ->fromModel(FarmlandType::class, 'name')
                    ->required()
                    ->title(__('Type'))
                    ->placeholder(__('Type')),

                Relation::make('farmland.status_id')
                    ->fromModel(FarmlandStatus::class, 'name')
                    ->required()
                    ->title(__('Status'))
                    ->placeholder(__('Status')),
            ]),

            Input::make('farmland.hectares_size')
                ->type('number')
                ->required()
                ->title(__('Size (ha)'))
                ->placeholder(__('Size in hectares')),
        ];
    }
}
