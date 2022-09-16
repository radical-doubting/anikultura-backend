<?php

namespace App\Orchid\Filters\Crop;

use App\Models\Crop\Crop;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Fields\Relation;

class CropFilter extends Filter
{
    public $parameters = [
        'crop',
    ];

    public function name(): string
    {
        return __('Crop');
    }

    public function run(Builder $builder): Builder
    {
        return $builder->whereHas('crop', function (Builder $query) {
            $query->where('slug', $this->request->get('crop'));
        });
    }

    public function display(): array
    {
        return [
            Relation::make('crop')
                ->fromModel(Crop::class, 'name', 'slug')
                ->value($this->request->get('crop'))
                ->title(__('Crop')),
        ];
    }

    public function value(): string
    {
        return $this->name().': '.Crop::where('slug', $this->request->get('crop'))->first()->name;
    }
}
