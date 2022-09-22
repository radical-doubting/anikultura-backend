<?php

namespace App\Orchid\Layouts\Site\Region;

use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Input;

class RegionEditLayout extends AnikulturaEditLayout
{
    protected function fields(): iterable
    {
        return [
            Input::make('region.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Name'))
                ->placeholder(__('Name')),
            Input::make('region.short_name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Short Name'))
                ->placeholder(__('Short Name')),
        ];
    }
}
