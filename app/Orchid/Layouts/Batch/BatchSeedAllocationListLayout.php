<?php

namespace App\Orchid\Layouts\Batch;

use App\Models\Batch\Batch;
use App\Models\Batch\BatchSeedAllocation;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Persona;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class BatchSeedAllocationListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'batchSeedAllocations';

    /**
     * @return bool
     */
    protected function striped(): bool
    {
        return true;
    }

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('farmer', __('Farmer'))
                ->sort()
                ->render(function (BatchSeedAllocation $batchSeedAllocation) {
                    $farmer = $batchSeedAllocation->farmer;

                    return new Persona($farmer->presenter());
                }),

            TD::make('crop', __('Crop'))
                ->sort()
                ->render(function (BatchSeedAllocation $batchSeedAllocation) {
                    $crop = $batchSeedAllocation->crop;
                    $element = !is_null($crop) ? Link::make($crop->name)
                        ->route('platform.crops.edit', $crop->id) : __('None');

                    return $element;
                }),

            TD::make('seed_amount', __('Seed Amount'))
                ->sort()
                ->render(function (BatchSeedAllocation $batchSeedAllocation) {
                    $seedAmount = $batchSeedAllocation->seed_amount;

                    return $seedAmount;
                }),

            TD::make('updated_at', __('Last edit'))
                ->sort()
                ->render(function (BatchSeedAllocation $batchSeedAllocation) {
                    return $batchSeedAllocation->updated_at->toDateTimeString();
                }),
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (BatchSeedAllocation $batchSeedAllocation) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Edit'))
                                // ->route('platform.batch-seed-allocations.edit', $batchSeedAllocation->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->method('remove')
                                ->confirm(__('Once the batch seed allocation is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->parameters([
                                    'id' => $batchSeedAllocation->id,
                                ]),
                        ]);
                }),
        ];
    }
}
