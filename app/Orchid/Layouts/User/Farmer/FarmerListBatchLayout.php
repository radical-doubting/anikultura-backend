<?php

namespace App\Orchid\Layouts\User\Farmer;

use App\Models\Batch\Batch;
use App\Orchid\Layouts\AnikulturaListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\TD;

class FarmerListBatchLayout extends AnikulturaListLayout
{
    protected $target = 'batches';

    protected function columns(): iterable
    {
        return [
            TD::make('farmschool_name', __('Farmschool Name'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Batch $batch) {
                    return Link::make($batch->farmschool_name)
                        ->route('platform.batches.edit', [$batch->id]);
                }),
        ];
    }
}
