<?php

namespace App\Orchid\Layouts\Batch;

use App\Models\Site\Municity;
use App\Models\Site\Province;
use App\Models\Site\Region;
use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;

class BatchEditSiteLayout extends AnikulturaEditLayout
{
    protected function fields(): iterable
    {
        return [
            Group::make([
                Relation::make('batch.region_id')
                    ->fromModel(Region::class, 'name')
                    ->required()
                    ->title('Region')
                    ->placeholder(__('Region')),
                Relation::make('batch.province_id')
                    ->fromModel(Province::class, 'name')
                    ->required()
                    ->title('Province')
                    ->placeholder(__('Province')),
            ]),
            Group::make([
                Relation::make('batch.municity_id')
                    ->fromModel(Municity::class, 'name')
                    ->required()
                    ->title('Municipality or City')
                    ->placeholder(__('Municipality or City')),
                Input::make('batch.barangay')
                    ->type('text')
                    ->max(255)
                    ->title(__('Barangay'))
                    ->placeholder(__('Barangay')),
            ]),
        ];
    }
}
