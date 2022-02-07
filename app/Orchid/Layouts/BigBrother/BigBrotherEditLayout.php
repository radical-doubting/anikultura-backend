<?php

namespace App\Orchid\Layouts\BigBrother;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class BigBrotherEditLayout extends Rows
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
            Input::make('big_brother_profile.organization_name')
                ->title(__('Affiliated Organization'))
                ->placeholder(__('Affiliated Organization'))
                ->required(),

            Input::make('big_brother_profile.age')
                ->title(__('Age'))
                ->type('number')
                ->placeholder(__('Age'))
                ->required(),
        ];
    }
}
