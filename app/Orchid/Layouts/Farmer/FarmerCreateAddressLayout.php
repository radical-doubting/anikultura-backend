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

class FarmerCreateAddressLayout extends Rows
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
                    ->title('House Number:')
                    ->placeholder('Enter house number.')
                    ->required(),

                Input::make('farmer_address.street')
                    ->title('Street:')
                    ->placeholder('Enter street.')
                    ->required(),

                Input::make('farmer_address.barangay')
                    ->title('Barangay:')
                    ->placeholder('Enter Barangay.')
                    ->required(),
            ]),

            Group::make([
                Input::make('farmer_address.city')
                    ->title('City:')
                    ->placeholder('Enter city.')
                    ->required(),

                Input::make('farmer_address.province')
                    ->title('Province:')
                    ->placeholder('Enter Province')
                    ->required(),

                Relation::make('farmer_address.region_id')
                    ->fromModel(Region::class, 'name')
                    ->required()
                    ->title('Region')
                    ->placeholder(__('Region')),
            ]),
        ];
    }
}
