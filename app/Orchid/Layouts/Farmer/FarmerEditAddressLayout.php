<?php

namespace App\Orchid\Layouts\Farmer;

use App\Models\Site\Region;
use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;

class FarmerEditAddressLayout extends AnikulturaEditLayout
{
    protected function fields(): iterable
    {
        return [
            Group::make([
                Input::make('farmer_address.house_number')
                    ->title(__('House Number'))
                    ->placeholder(__('House Number'))
                    ->required(),

                Input::make('farmer_address.street')
                    ->title(__('Street'))
                    ->placeholder(__('Street'))
                    ->required(),

                Input::make('farmer_address.barangay')
                    ->title(__('Barangay'))
                    ->placeholder(__('Barangay'))
                    ->required(),
            ]),

            Group::make([
                Input::make('farmer_address.municity')
                    ->title(__('Municipality / City'))
                    ->placeholder(__('Municipality / City'))
                    ->required(),

                Input::make('farmer_address.province')
                    ->title(__('Province'))
                    ->placeholder(__('Province'))
                    ->required(),

                Relation::make('farmer_address.region_id')
                    ->fromModel(Region::class, 'name')
                    ->required()
                    ->title(__('Region'))
                    ->placeholder(__('Region')),
            ]),
        ];
    }
}
