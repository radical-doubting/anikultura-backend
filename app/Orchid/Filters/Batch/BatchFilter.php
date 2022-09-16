<?php

namespace App\Orchid\Filters\Batch;

use App\Models\Batch\Batch;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Fields\Relation;

class BatchFilter extends Filter
{
    public $parameters = [
        'batch',
    ];

    public function name(): string
    {
        return __('Batch');
    }

    public function run(Builder $builder): Builder
    {
        return $builder->whereHas('batch', function (Builder $query) {
            $query->where('slug', $this->request->get('batch'));
        });
    }

    public function display(): array
    {
        return [
            Relation::make('batch')
                ->fromModel(Batch::class, 'farmschool_name', 'slug')
                ->value($this->request->get('batch'))
                ->title(__('Batch')),
        ];
    }

    public function value(): string
    {
        return $this->name().': '.Batch::where('slug', $this->request->get('batch'))->first()->farmschool_name;
    }
}
