<?php

namespace App\Orchid\Layouts\Farmland;

use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;

class FarmlandCreateAddressLayout extends Rows
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
                Input::make('house_number')
                    ->title('House Number:')
                    ->placeholder('Enter house number.')
                    ->required(),
        
                Input::make('street')
                    ->title('Street:')
                    ->placeholder('Enter street.')
                    ->required(),

                Input::make('barangay')
                    ->title('Barangay:')
                    ->placeholder('Enter Barangay.')
                    ->required(),
            ]),

            Group::make([
                Input::make('city')
                    ->title('City:')
                    ->placeholder('Enter city.')
                    ->required(),
        
                Input::make('province')
                    ->title('Province:')
                    ->placeholder('Enter Province')
                    ->required(),

                Input::make('region')
                    ->title('Region:')
                    ->placeholder('Enter Region.')
                    ->required(),
            ]),
        ];
    }
}
