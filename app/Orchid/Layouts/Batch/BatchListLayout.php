<?php

namespace App\Orchid\Layouts\Batch;

use App\Models\Batch\Batch;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class BatchListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'batches';

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

            TD::make('farmschool_name', __('Farmschool Name'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Batch $batches) {
                    return Link::make($batches->farmschool_name)
                        ->route('platform.batches.edit', $batches->id);
                }),
            TD::make('region', __('Region'))
                ->sort()
                ->render(function (Batch $batches) {
                    return Link::make($batches->region->fullName)
                        ->route('platform.batches.edit', $batches->id);
                }),
            TD::make('province', __('Province'))
                ->sort()
                ->render(function (Batch $batches) {
                    return Link::make($batches->province->name)
                        ->route('platform.batches.edit', $batches->id);
                }),
            TD::make('municity', __('Municity'))
                ->sort()
                ->render(function (Batch $batches) {
                    return Link::make($batches->municity->name)
                        ->route('platform.batches.edit', $batches->id);
                }),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->cantHide()
                ->width('100px')
                ->render(function (Batch $batches) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Edit'))
                                ->route('platform.batches.edit', $batches->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->method('remove')
                                ->confirm(__('Once the batch is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->parameters([
                                    'id' => $batches->id,
                                ]),
                        ]);
                }),
        ];
    }
}
