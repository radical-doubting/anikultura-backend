<?php

namespace App\Orchid\Filters\Farmland;

use App\Models\Farmland\FarmlandStatus;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Relation;

class FarmlandStatusFilter extends Filter
{
    /**
     * @var array
     */
    public $parameters = [
        'status',
    ];

    /**
     * @return string
     */
    public function name(): string
    {
        return __('Farmland Status');
    }

    /**
     * @param  Builder  $builder
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        return $builder->whereHas('status', function (Builder $query) {
            $query->where('slug', $this->request->get('status'));
        });
    }

    /**
     * @return Field[]
     */
    public function display(): array
    {
        return [
            Relation::make('status')
                ->fromModel(FarmlandStatus::class, 'name', 'slug')
                ->empty()
                ->value($this->request->get('status'))
                ->title(__('Farmland Status')),
        ];
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->name().': '.FarmlandStatus::where('slug', $this->request->get('status'))->first()->name;
    }
}
