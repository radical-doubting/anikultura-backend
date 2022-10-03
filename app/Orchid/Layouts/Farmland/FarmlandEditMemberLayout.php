<?php

namespace App\Orchid\Layouts\Farmland;

use App\Models\User\Farmer\Farmer;
use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Relation;

class FarmlandEditMemberLayout extends AnikulturaEditLayout
{
    protected function fields(): iterable
    {
        return [
            Relation::make('farmland.farmers.')
                ->fromModel(Farmer::class, 'name')
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
