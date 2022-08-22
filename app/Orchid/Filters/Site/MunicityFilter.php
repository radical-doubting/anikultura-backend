<?php

namespace App\Orchid\Filters\Site;

use App\Models\Site\Municity;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Relation;

class MunicityFilter extends Filter
{
    /**
     * @var array
     */
    public $parameters = [
        'municity',
    ];

    /**
     * @return string
     */
    public function name(): string
    {
        return __('Municipality and city');
    }

    /**
     * @param  Builder  $builder
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        return $builder->whereHas('municity', function (Builder $query) {
            $query->where('slug', $this->request->get('municity'));
        });
    }

    /**
     * @return Field[]
     */
    public function display(): array
    {
        return [
            Relation::make('municity')
                ->fromModel(Municity::class, 'name', 'slug')
                ->empty()
                ->value($this->request->get('municity'))
                ->title(__('Municipality and city')),
        ];
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->name().': '.Municity::where('slug', $this->request->get('municity'))->first()->name;
    }
}
