<?php

namespace App\Orchid\Filters\Crop;

use App\Models\Crop\Crop;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Relation;

class CropFilter extends Filter
{
    /**
     * @var array
     */
    public $parameters = [
        'crop',
    ];

    /**
     * @return string
     */
    public function name(): string
    {
        return __('Crop');
    }

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        return $builder->whereHas('crop', function (Builder $query) {
            $query->where('slug', $this->request->get('crop'));
        });
    }

    /**
     * @return Field[]
     */
    public function display(): array
    {
        return [
            Relation::make('crop')
                ->fromModel(Crop::class, 'name', 'slug')
                ->empty()
                ->value($this->request->get('crop'))
                ->title(__('Crop')),
        ];
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->name() . ': ' . Crop::where('slug', $this->request->get('crop'))->first()->name;
    }
}
