<?php

namespace App\Orchid\Layouts\Farmland;

use App\Models\User;
use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;

class FarmlandEditMemberLayout extends Rows
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
            Relation::make('farmland.members.')
                ->fromModel(User::class, 'name')
                ->applyScope('farmer')
                ->searchColumns('first_name', 'last_name')
                ->displayAppend('full_name')
                ->required()
                ->multiple()
                ->help(__('Search the name of this farmland\'s members'))
                ->title(__('Members'))
                ->placeholder(__('Members')),
        ];
    }
}
