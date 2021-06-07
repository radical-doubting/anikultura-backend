<?php

namespace App\Orchid\Layouts\Batch;

use Orchid\Screen\Layouts\Table;
use App\Models\Batch\Batches;
use Illuminate\Bus\Batch;
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
                        ->route('platform.batches.edit', $batches->id);
                }),

                TD::make('assigned_farmschool_name', __('Assigned Farmschool Name'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Batches $batches) {
                    return Link::make($batches->assigned_farmschool_name)
                        ->route('platform.batches.edit', $batches->id);
                }),

                TD::make('number_seeds_distributed', __('Number of Seeds Distributed'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Batches $batches) {
                    return Link::make($batches-> number_seeds_distributed)
                        ->route('platform.batches.edit', $batches->id);
                }),

                TD::make('region', __('Region'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Batches $batches) {
                    $regions = $batches->region;
                    $has_region = !is_null($regions);
                    $element = $has_region ? Link::make($regions->name)
                        ->route('platform.batches.edit', $regions->id) : __('None');

                    return $element;
                }),

                TD::make('province', __('Province'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Batches $batches) {
                    $provinces = $batches->provinces;
                    $has_province = !is_null($provinces);
                    $element = $has_province ? Link::make($provinces->name)
                        ->route('platform.batches.edit', $provinces->id) : __('None');

                    return $element;
                }),

                TD::make('municity', __('Municity'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Batches $batches) {
                    $municities = $batches->municities;
                    $has_municity = !is_null($municities);
                    $element = $has_municity ? Link::make($municities->name)
                        ->route('platform.batches.edit', $municities->id) : __('None');

                    return $element;
                }),

                TD::make('barangay', __('Barangay'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Batches $batches) {
                    $barangays = $batches->barangays;
                    $has_barangays = !is_null($barangays);
                    $element = $has_barangays ? Link::make($barangays->name)
                        ->route('platform.batches.edit', $barangays->id) : __('None');

                    return $element;
                }),

                TD::make('farmer_names', __('Enrolled Farmers'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Batches $batches) {
                    $farmers = $batches->farmers;
                    $has_farmers = !is_null($farmers);
                    $element = $has_farmers ? Link::make($farmers->name)
                        ->route('platform.batches.edit', $farmers->id) : __('None');

                    return $element;
                }),
                /*
                TD::make('farmer_names', __('Enrolled Farmers'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Batches $batches) {
                    return Link::make($batches-> farmer_names)
                        ->route('platform.batches.edit', $batches->id);
                }),*/
                
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
