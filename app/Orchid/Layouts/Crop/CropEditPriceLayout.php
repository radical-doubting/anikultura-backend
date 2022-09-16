<?php

namespace App\Orchid\Layouts\Crop;

use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;

class CropEditPriceLayout extends AnikulturaEditLayout
{
    protected function fields(): iterable
    {
        return [
            Group::make([
                Input::make('crop.gross_returns_per_ha')
                    ->required()
                    ->title(__('Gross Returns per Hectare (PHP/ha)'))
                    ->mask([
                        'alias' => 'currency',
                        'prefix' => 'PHP ',
                        'groupSeparator' => ',',
                        'digitsOptional' => false,
                        'removeMaskOnSubmit' => true,
                    ]),
                Input::make('crop.total_costs_per_ha')
                    ->required()
                    ->title(__('Total Costs per Hectare (PHP/ha)'))
                    ->mask([
                        'alias' => 'currency',
                        'prefix' => 'PHP ',
                        'groupSeparator' => ',',
                        'digitsOptional' => false,
                        'removeMaskOnSubmit' => true,
                    ]),
            ]),
            Group::make([
                Input::make('crop.production_cost_per_kg')
                    ->required()
                    ->title(__('Production Price per Kilogram (PHP/kg)'))
                    ->mask([
                        'alias' => 'currency',
                        'prefix' => 'PHP ',
                        'groupSeparator' => ',',
                        'digitsOptional' => false,
                        'removeMaskOnSubmit' => true,
                    ]),
                Input::make('crop.farmgate_price_per_kg')
                    ->required()
                    ->title(__('Farmgate Price per Kilogram (PHP/kg)'))
                    ->mask([
                        'alias' => 'currency',
                        'prefix' => 'PHP ',
                        'groupSeparator' => ',',
                        'digitsOptional' => false,
                        'removeMaskOnSubmit' => true,
                    ]),
            ]),
        ];
    }
}
