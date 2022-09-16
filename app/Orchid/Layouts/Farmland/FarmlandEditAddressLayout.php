<?php

namespace App\Orchid\Layouts\Farmland;

use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;

class FarmlandEditAddressLayout extends AnikulturaEditLayout
{
    protected function fields(): iterable
    {
        return [
            Group::make([
                Input::make('house_number')
                    ->title('House Number:')
                    ->placeholder('Enter house number')
                    ->required(),

                Input::make('street')
                    ->title('Street:')
                    ->placeholder('Enter street name')
                    ->required(),

                Input::make('barangay')
                    ->title('Barangay:')
                    ->placeholder('Enter Barangay name')
                    ->required(),
            ]),

            Group::make([
                Input::make('city')
                    ->title('City:')
                    ->placeholder('Enter city name')
                    ->required(),

                Input::make('province')
                    ->title('Province:')
                    ->placeholder('Enter Province name')
                    ->required(),

                Input::make('region')
                    ->title('Region:')
                    ->placeholder('Enter Region name')
                    ->required(),
            ]),
        ];
    }
}
