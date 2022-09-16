<?php

namespace App\Orchid\Layouts\Farmland;

use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;

class FarmlandEditAppStatusLayout extends AnikulturaEditLayout
{
    protected function fields(): iterable
    {
        return [
            Group::make([
                Input::make('verified_by')
                    ->title('Verified By:')
                    ->disabled()
                    ->required(),

                Input::make('position')
                    ->title('Position:')
                    ->disabled()
                    ->required(),
            ]),

            Group::make([
                Input::make('office')
                    ->title('Office:')
                    ->disabled()
                    ->required(),

                Input::make('contact_number')
                    ->title('Contact Number:')
                    ->disabled()
                    ->required(),
            ]),

            Select::make('mode_of_application')
                ->title('Mode of Application:')
                ->required()
                ->options(['DSWD', 'DA', 'LGU', 'TESDA', 'Walk-In', 'Others']),
        ];
    }
}
