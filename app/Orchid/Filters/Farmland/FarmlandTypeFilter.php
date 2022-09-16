<?php

namespace App\Orchid\Filters\Farmland;

use App\Models\Farmland\FarmlandType;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Fields\Relation;

class FarmlandTypeFilter extends Filter
{
    public $parameters = [
        'type',
    ];

    public function name(): string
    {
        return __('Farmland Type');
    }

    public function run(Builder $builder): Builder
    {
        return $builder->whereHas('type', function (Builder $query) {
            $query->where('slug', $this->request->get('type'));
        });
    }

    public function display(): array
    {
        return [
            Relation::make('type')
                ->fromModel(FarmlandType::class, 'name', 'slug')
                ->value($this->request->get('type'))
                ->title(__('Farmland Type')),
        ];
    }

    public function value(): string
    {
        return $this->name().': '.FarmlandType::where('slug', $this->request->get('type'))->first()->name;
    }
}
