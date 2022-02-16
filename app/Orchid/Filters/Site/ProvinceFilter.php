<?php

namespace App\Orchid\Filters\Site;

use App\Models\Site\Province;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Relation;

class ProvinceFilter extends Filter
{
    /**
     * @var array
     */
    public $parameters = [
        'province',
    ];

    /**
     * @return string
     */
    public function name(): string
    {
        return __('Province');
    }

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        return $builder->whereHas('province', function (Builder $query) {
            $query->where('slug', $this->request->get('province'));
        });
    }

    /**
     * @return Field[]
     */
    public function display(): array
    {
        return [
            Relation::make('province')
                ->fromModel(Province::class, 'name', 'slug')
                ->empty()
                ->value($this->request->get('province'))
                ->title(__('Province')),
        ];
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->name() . ': ' . Province::where('slug', $this->request->get('province'))->first()->name;
    }
}
