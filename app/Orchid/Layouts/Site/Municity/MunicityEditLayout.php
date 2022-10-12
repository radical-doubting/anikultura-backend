<?php

namespace App\Orchid\Layouts\Site\Municity;

use App\Models\Site\Province;
use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;

class MunicityEditLayout extends AnikulturaEditLayout
{
    protected function fields(): iterable
    {
        return [
            Relation::make('municity.province_id')
                ->fromModel(Province::class, 'name')
                ->required()
                ->title(__('Province'))
                ->placeholder(__('Province')),
            Input::make('municity.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Name'))
                ->placeholder(__('Name')),
        ];
    }
}