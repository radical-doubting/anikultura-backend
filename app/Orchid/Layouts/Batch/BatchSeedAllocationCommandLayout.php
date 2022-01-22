<?php

namespace App\Orchid\Layouts\Batch;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Layouts\Rows;
use Orchid\Support\Color;

class BatchSeedAllocationCommandLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
        $currentBatch = $this->query['batch'];

        return [
            Group::make([
                Link::make(__('Allocate seeds'))
                    ->type(Color::DEFAULT())
                    ->right()
                    ->icon('orchid-old')
                    ->route('platform.batch-seed-allocations.create', $currentBatch),
            ])->autoWidth(),
        ];
    }
}
