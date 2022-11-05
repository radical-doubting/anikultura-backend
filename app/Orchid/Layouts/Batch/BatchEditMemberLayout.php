<?php

namespace App\Orchid\Layouts\Batch;

use App\Models\User\BigBrother\BigBrother;
use App\Models\User\Farmer\Farmer;
use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Relation;

class BatchEditMemberLayout extends AnikulturaEditLayout
{
    protected function fields(): iterable
    {
        return [
            Relation::make('batch.farmers.')
                ->fromModel(Farmer::class, 'name')
                ->searchColumns('first_name', 'last_name')
                ->displayAppend('fullName')
                ->required()
                ->multiple()
                ->help(__('Search the name of this batch\'s farmers'))
                ->title(__('Farmers'))
                ->placeholder(__('Farmers')),

            Relation::make('batch.bigBrothers.')
                ->fromModel(BigBrother::class, 'name')
                ->searchColumns('first_name', 'last_name')
                ->displayAppend('fullName')
                ->required()
                ->multiple()
                ->help(__('Search the name of this batch\'s big brothers'))
                ->title(__('Big Brothers'))
                ->placeholder(__('Big Brothers')),
        ];
    }
}
