<?php

namespace App\Orchid\Filters\Site;

use App\Models\Site\Region;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Fields\Relation;

class RegionFilter extends Filter
{
    public $parameters = [
        'region',
    ];

    public function name(): string
    {
        return __('Region');
    }

    public function run(Builder $builder): Builder
    {
        return $builder->whereHas('region', function (Builder $query) {
            $query->where('slug', $this->request->get('region'));
        });
    }

    public function display(): array
    {
        return [
            Relation::make('region')
                ->fromModel(Region::class, 'name', 'slug')
                ->displayAppend('fullName')
                ->value($this->request->get('region'))
                ->title(__('Region')),
        ];
    }

    public function value(): string
    {
        return $this->name().': '.Region::where('slug', $this->request->get('region'))->first()->fullName;
    }
}
