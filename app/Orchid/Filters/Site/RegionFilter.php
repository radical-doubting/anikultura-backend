<?php

namespace App\Orchid\Filters\Site;

use App\Models\Site\Region;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Relation;

class RegionFilter extends Filter
{
    /**
     * @var array
     */
    public $parameters = [
        'region',
    ];

    /**
     * @return string
     */
    public function name(): string
    {
        return __('Region');
    }

    /**
     * @param  Builder  $builder
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        return $builder->whereHas('region', function (Builder $query) {
            $query->where('slug', $this->request->get('region'));
        });
    }

    /**
     * @return Field[]
     */
    public function display(): array
    {
        return [
            Relation::make('region')
                ->fromModel(Region::class, 'name', 'slug')
                ->displayAppend('fullName')
                ->empty()
                ->value($this->request->get('region'))
                ->title(__('Region')),
        ];
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->name().': '.Region::where('slug', $this->request->get('region'))->first()->fullName;
    }
}
