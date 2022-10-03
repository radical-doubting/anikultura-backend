<?php

namespace App\Orchid\Filters\User;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Fields\Input;

class UserNameFilter extends Filter
{
    public $parameters = [
        'name',
    ];

    public function name(): string
    {
        return __('Name');
    }

    public function run(Builder $builder): Builder
    {
        $name = $this->request->get('name');

        return $builder
            ->where('name', 'like', "%$name%")
            ->orWhere('first_name', 'like', "%$name%")
            ->orWhere('middle_name', 'like', "%$name%")
            ->orWhere('last_name', 'like', "%$name%");
    }

    public function display(): array
    {
        return [
            Input::make('name')
                ->type('text')
                ->value($this->request->get('name'))
                ->title('Name'),
        ];
    }
}
