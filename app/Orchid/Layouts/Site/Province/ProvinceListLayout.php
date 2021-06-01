<?php

namespace App\Orchid\Layouts\Site\Province;

use App\Models\Site\Province;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ProvinceListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'provinces';

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
                ->render(function (Province $province) {
                    return Link::make($province->id)
                        ->route('platform.sites.provinces.edit', $province->id);
                }),

            TD::make('name', __('Name'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Province $province) {
                    return Link::make($province->name)
                        ->route('platform.sites.provinces.edit', $province->id);
                }),

            TD::make('region', __('Region'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Province $province) {
                    return Link::make($province->region->name)
                        ->route('platform.sites.regions.edit', $province->region->id);
                }),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->cantHide()
                ->width('100px')
                ->render(function (Province $province) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Edit'))
                                ->route('platform.sites.provinces.edit', $province->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->method('remove')
                                ->confirm(__('Once the province is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->parameters([
                                    'id' => $province->id,
                                ]),
                        ]);
                }),
        ];
    }
}
