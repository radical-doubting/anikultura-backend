<?php

namespace App\Orchid\Layouts\Batch;

use App\Models\Batch\BatchSeedAllocation;
use App\Orchid\Layouts\AnikulturaListLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\TD;

class BatchSeedAllocationListLayout extends AnikulturaListLayout
{
    protected $target = 'batchSeedAllocations';

    protected function columns(): iterable
    {
        $currentBatch = $this->query['batch'];

        return [
            TD::make('farmer', __('Farmer'))
                ->sort()
                ->render(function (BatchSeedAllocation $batchSeedAllocation) use ($currentBatch) {
                    return Link::make($batchSeedAllocation->farmer->fullName)
                        ->route('platform.batch-seed-allocations.edit', [
                            'batch' => $currentBatch,
                            'batchSeedAllocation' => $batchSeedAllocation,
                        ]);
                }),
            TD::make('crop', __('Crop'))
                ->sort()
                ->render(function (BatchSeedAllocation $batchSeedAllocation) use ($currentBatch) {
                    return Link::make($batchSeedAllocation->crop->name)
                        ->route('platform.batch-seed-allocations.edit', [
                            'batch' => $currentBatch,
                            'batchSeedAllocation' => $batchSeedAllocation,
                        ]);
                }),
            TD::make('seed_amount', __('Seed Amount'))
                ->sort()
                ->render(function (BatchSeedAllocation $batchSeedAllocation) use ($currentBatch) {
                    return Link::make((string) $batchSeedAllocation->seed_amount)
                        ->route('platform.batch-seed-allocations.edit', [
                            'batch' => $currentBatch,
                            'batchSeedAllocation' => $batchSeedAllocation,
                        ]);
                }),
            TD::make('updated_at', __('Last Edit'))
                ->sort()
                ->render(function (BatchSeedAllocation $batchSeedAllocation) {
                    return $batchSeedAllocation->updated_at->toDateTimeString();
                }),
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (BatchSeedAllocation $batchSeedAllocation) use ($currentBatch) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Edit'))
                                ->route('platform.batch-seed-allocations.edit', [
                                    'batch' => $currentBatch,
                                    'batchSeedAllocation' => $batchSeedAllocation,
                                ])
                                ->icon('pencil'),
                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->method('removeBatchSeedAllocation')
                                ->confirm(__('Once the batch seed allocation is deleted, all of its resources and data will be permanently deleted.'))
                                ->parameters([
                                    'id' => $batchSeedAllocation->id,
                                ]),
                        ]);
                }),
        ];
    }
}
