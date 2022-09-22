<?php

namespace App\Orchid\Layouts\Batch;

use App\Models\Batch\Batch;
use App\Orchid\Layouts\AnikulturaListLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\TD;

class BatchListLayout extends AnikulturaListLayout
{
    protected $target = 'batches';

    protected function columns(): array
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
            TD::make('region', __('Region'))
                ->sort()
                ->render(function (Batch $batch) {
                    return Link::make($batch->region->fullName)
                        ->route('platform.batches.edit', [$batch->id]);
                }),
            TD::make('province', __('Province'))
                ->sort()
                ->render(function (Batch $batch) {
                    return Link::make($batch->province->name)
                        ->route('platform.batches.edit', [$batch->id]);
                }),
            TD::make('municity', __('Municity'))
                ->sort()
                ->render(function (Batch $batch) {
                    return Link::make($batch->municity->name)
                        ->route('platform.batches.edit', [$batch->id]);
                }),
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->cantHide()
                ->width('100px')
                ->render(function (Batch $batch) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Edit'))
                                ->route('platform.batches.edit', [$batch->id])
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->method('remove')
                                ->confirm(__('Once the batch is deleted, all of its resources and data will be permanently deleted.'))
                                ->parameters([
                                    'id' => $batch->id,
                                ]),
                        ]);
                }),
        ];
    }
}
