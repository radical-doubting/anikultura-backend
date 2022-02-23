<?php

namespace App\Orchid\Layouts\Crop;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class CropEditPriceLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): array
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
