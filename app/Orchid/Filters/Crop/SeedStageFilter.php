<?php

namespace App\Orchid\Filters\Crop;

use App\Models\Crop\SeedStage;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Relation;

class SeedStageFilter extends Filter
{
    /**
     * @var array
     */
    public $parameters = [
        'seedStage',
    ];

    /**
     * @return string
     */
    public function name(): string
    {
        return __('Seed Stage');
    }

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        return $builder->whereHas('seedStage', function (Builder $query) {
            $query->where('slug', $this->request->get('seedStage'));
        });
    }

    /**
     * @return Field[]
     */
    public function display(): array
    {
        return [
            Relation::make('seedStage')
                ->fromModel(SeedStage::class, 'name', 'slug')
                ->empty()
                ->value($this->request->get('seedStage'))
                ->title(__('Seed Stage')),
        ];
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->name() . ': ' . SeedStage::where('slug', $this->request->get('seedStage'))->first()->name;
    }
}
