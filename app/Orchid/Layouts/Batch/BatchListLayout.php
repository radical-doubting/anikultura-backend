<?php

namespace App\Orchid\Layouts\Batch;

use Orchid\Screen\Layouts\Table;
use App\Models\Batch\Batches;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
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
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('id', __('ID'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Batches $batches) {
                    return Link::make($batches->id)
                        ->route('platform.batch.edit', $batches->id);
                }),

                TD::make('assigned_farmschhol_name', __('Assigned Farmschool Name'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Batches $batches) {
                    return Link::make($batches->assigned_farmschool_name)
                        ->route('platform.batch.edit', $batches->id);
                }),

                TD::make('assigned_site', __('Assigned Site'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Batches $batches) {
                    return Link::make($batches->assigned_site)
                        ->route('platform.batch.edit', $batches->id);
                }),

                TD::make('number_seeds_distributed', __('Number of Seeds Distributed'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Batches $batches) {
                    return Link::make($batches-> number_seeds_distributed)
                        ->route('platform.batch.edit', $batches->id);
                }),

                TD::make('farmers_names', __('Enrolled Farmers'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Batches $batches) {
                    return Link::make($batches-> farmer_names)
                        ->route('platform.batch.edit', $batches->id);
                }),
                
                TD::make('updated_at', __('Last edit'))
                ->sort()
                ->render(function (Batches $batches) {
                    return $batches->updated_at->toDateTimeString();
                }),

                TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Batches $batches) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.batch.edit', $batches->id)
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
