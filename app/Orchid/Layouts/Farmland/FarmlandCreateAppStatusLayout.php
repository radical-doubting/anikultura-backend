<?php

namespace App\Orchid\Layouts\Farmland;

use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;

class FarmlandCreateAppStatusLayout extends Rows
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
                ->options(["DSWD", "DA", "LGU", "TESDA", "Walk-In", "Others"]),
        ];
    }
}
