<?php

namespace App\Orchid\Layouts\Batch;

use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;
use Orchid\Support\Color;

class BatchSeedAllocationCommandLayout extends AnikulturaEditLayout
{
    protected function fields(): array
    {
        $currentBatch = $this->query['batch'];

        $link = Link::make(__('Allocate seeds'))
            ->type(Color::DEFAULT())
            ->icon('plus-alt');

        if ($currentBatch->exists) {
            $link->route('platform.batch-seed-allocations.create', [$currentBatch]);
        }

        return [
            Group::make([$link])->autoWidth(),
        ];
    }
}
