<?php

namespace App\Orchid\Filters\Site;

use App\Models\Site\Province;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Fields\Relation;

class ProvinceFilter extends Filter
{
    public $parameters = [
        'province',
    ];

    public function name(): string
    {
        return __('Province');
    }

    public function run(Builder $builder): Builder
    {
        return $builder->whereHas('province', function (Builder $query) {
            $query->where('slug', $this->request->get('province'));
        });
    }

    public function display(): array
    {
        return [
            Relation::make('province')
                ->fromModel(Province::class, 'name', 'slug')
                ->value($this->request->get('province'))
                ->title(__('Province')),
        ];
    }

    public function value(): string
    {
        return $this->name().': '.Province::where('slug', $this->request->get('province'))->first()->name;
    }
}
