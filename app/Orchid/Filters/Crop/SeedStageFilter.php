<?php

namespace App\Orchid\Filters\Crop;

use App\Models\Crop\SeedStage;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Fields\Relation;

class SeedStageFilter extends Filter
{
    public $parameters = [
        'seedStage',
    ];

    public function name(): string
    {
        return __('Seed Stage');
    }

    public function run(Builder $builder): Builder
    {
        return $builder->whereHas('seedStage', function (Builder $query) {
            $query->where('slug', $this->request->get('seedStage'));
        });
    }

    public function display(): array
    {
        return [
            Relation::make('seedStage')
                ->fromModel(SeedStage::class, 'name', 'slug')
                ->value($this->request->get('seedStage'))
                ->title(__('Seed Stage')),
        ];
    }

    public function value(): string
    {
        return $this->name().': '.SeedStage::where('slug', $this->request->get('seedStage'))->first()->name;
    }
}
