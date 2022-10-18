<?php

namespace App\Orchid\Layouts\Batch;

use App\Models\Farmland\Farmland;
use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Relation;

class BatchEditFarmlandLayout extends AnikulturaEditLayout
{
    protected function fields(): iterable
    {
        return [
            Relation::make('batch.farmlands.')
                ->fromModel(Farmland::class, 'name')
                ->searchColumns('name')
                ->disabled()
                ->required()
                ->multiple()
                ->help(__('Search the name of this batch\'s farmlands'))
                ->title(__('Farmlands'))
                ->placeholder(__('Farmlands')),
        ];
    }
}
