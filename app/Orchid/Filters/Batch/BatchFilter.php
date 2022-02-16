<?php

namespace App\Orchid\Filters\Batch;

use App\Models\Batch\Batch;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Relation;

class BatchFilter extends Filter
{
    /**
     * @var array
     */
    public $parameters = [
        'batch',
    ];

    /**
     * @return string
     */
    public function name(): string
    {
        return __('Batch');
    }

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        return $builder->whereHas('batch', function (Builder $query) {
            $query->where('slug', $this->request->get('batch'));
        });
    }

    /**
     * @return Field[]
     */
    public function display(): array
    {
        return [
            Relation::make('batch')
                ->fromModel(Batch::class, 'farmschool_name', 'slug')
                ->empty()
                ->value($this->request->get('batch'))
                ->title(__('Batch')),
        ];
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->name() . ': ' . Batch::where('slug', $this->request->get('batch'))->first()->farmschool_name;
    }
}
