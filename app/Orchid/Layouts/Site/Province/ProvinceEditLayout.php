<?php

namespace App\Orchid\Layouts\Site\Province;

use App\Models\Site\Region;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layouts\Rows;

class ProvinceEditLayout extends Rows
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
            Input::make('province.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Name'))
                ->placeholder(__('Name')),
            Relation::make('province.region_id')
                ->fromModel(Region::class, 'name')
                ->displayAppend('fullName')
                ->required()
                ->title(__('Region'))
                ->placeholder(__('Region')),
        ];
    }
}
