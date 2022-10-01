<?php

namespace App\Orchid\Layouts\User\Farmer;

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
                Input::make('farmerAddress.house_number')
                    ->title(__('House Number'))
                    ->placeholder(__('House Number'))
                    ->required(),

                Input::make('farmerAddress.street')
                    ->title(__('Street'))
                    ->placeholder(__('Street'))
                    ->required(),

                Input::make('farmerAddress.barangay')
                    ->title(__('Barangay'))
                    ->placeholder(__('Barangay'))
                    ->required(),
            ]),

            Group::make([
                Input::make('farmerAddress.municity')
                    ->title(__('Municipality / City'))
                    ->placeholder(__('Municipality / City'))
                    ->required(),

                Input::make('farmerAddress.province')
                    ->title(__('Province'))
                    ->placeholder(__('Province'))
                    ->required(),

                Relation::make('farmerAddress.region_id')
                    ->fromModel(Region::class, 'name')
                    ->required()
                    ->title(__('Region'))
                    ->placeholder(__('Region')),
            ]),
        ];
    }
}
