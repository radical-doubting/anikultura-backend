<?php

namespace App\Orchid\Layouts\Site\Municity;

use App\Models\Site\Province;
use App\Models\Site\Region;
use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use App\Orchid\Layouts\Site\Municity\MunicityListenerLayout;

class MunicityEditLayout extends AnikulturaEditLayout
{
    protected function fields(): iterable
    {
        $data = $this->query->get('regionId');

        return [
            Relation::make('test')
                ->fromModel(Region::class, 'id')
                ->displayAppend('fullName')
                ->required()
                ->title(__('Region'))
                ->placeholder(__('Region')),
            Relation::make('municity.province_id')
                ->fromModel(Province::class, 'name')
                ->required()
                ->applyScope('ProvinceBelongToRegion', $data)
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
