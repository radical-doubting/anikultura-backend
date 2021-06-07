<?php

namespace App\Orchid\Layouts\Farmer;

use App\Models\Farmer\FarmerProfile;
use App\Models\Site\Region;
use Orchid\Screen\Field;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Relation;

class FarmerEditAddressLayout extends Rows
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
                Input::make('farmer_address.city')
                    ->title(__('City'))
                    ->placeholder(__('City'))
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
