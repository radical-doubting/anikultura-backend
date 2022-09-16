<?php

namespace App\Orchid\Layouts\Batch;

use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Input;

class BatchEditLayout extends AnikulturaEditLayout
{
    protected function fields(): iterable
    {
        return [
            Input::make('batch.farmschool_name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Farmschool Name'))
                ->placeholder(__('Farmschool Name')),
        ];
    }
}
