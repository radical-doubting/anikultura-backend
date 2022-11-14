<?php

namespace App\Orchid\Layouts\Site\Province;

use App\Models\Site\Region;
use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;

class ProvinceEditLayout extends AnikulturaEditLayout
{
    protected function fields(): iterable
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
