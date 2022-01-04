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
                ->render(function (Batch $batches) {
                    return Link::make($batches->id)
                        ->route('platform.batches.edit', $batches->id);
                }),
            TD::make('assigned_farmschool_name', __('Assigned Farmschool Name'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Batch $batches) {
                    return Link::make($batches->assigned_farmschool_name)
                        ->route('platform.batches.edit', $batches->id);
                }),
            TD::make('number_seeds_distributed', __('Number of Seeds Distributed'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Batch $batches) {
                    return Link::make($batches->number_seeds_distributed)
                        ->route('platform.batches.edit', $batches->id);
                }),
            TD::make('region', __('Region'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Batch $batches) {
                    $region = $batches->region;
                    $has_region = !is_null($region);
                    $element = $has_region ? Link::make($region->name)
                        ->route('platform.batches.edit', $region->id) : __('None');

                    return $element;
                }),
            TD::make('province', __('Province'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Batch $batches) {
                    $province = $batches->province;
                    $has_province = !is_null($province);
                    $element = $has_province ? Link::make($province->name)
                        ->route('platform.batches.edit', $province->id) : __('None');

                    return $element;
                }),
            TD::make('municity', __('Municity'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Batch $batches) {
                    $municity = $batches->municity;
                    $has_municity = !is_null($municity);
                    $element = $has_municity ? Link::make($municity->name)
                        ->route('platform.batches.edit', $municity->id) : __('None');

                    return $element;
                }),
            TD::make('barangay', __('Barangay'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Batch $batches) {
                    return Link::make($batches->barangay)
                        ->route('platform.batches.edit', $batches->id);
                }),
            TD::make('updated_at', __('Last edit'))
                ->sort()
                ->render(function (Batch $batches) {
                    return $batches->updated_at->toDateTimeString();
                }),
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
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
