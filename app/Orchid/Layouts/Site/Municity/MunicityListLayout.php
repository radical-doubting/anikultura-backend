<?php

namespace App\Orchid\Layouts\Site\Municity;

use App\Models\Site\Municity;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class MunicityListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'municities';

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
                ->render(function (Municity $municity) {
                    return Link::make($municity->id)
                        ->route('platform.sites.municities.edit', $municity->id);
                }),

            TD::make('name', __('Name'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Municity $municity) {
                    return Link::make($municity->name)
                        ->route('platform.sites.municities.edit', $municity->id);
                }),

            TD::make('province', __('Province'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Municity $municity) {
                    return Link::make($municity->province->name)
                        ->route('platform.sites.provinces.edit', $municity->province->id);
                }),

            TD::make('region', __('Region'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Municity $municity) {
                    return Link::make($municity->region->name)
                        ->route('platform.sites.regions.edit', $municity->region->id);
                }),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->cantHide()
                ->width('100px')
                ->render(function (Municity $municity) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Edit'))
                                ->route('platform.sites.municities.edit', $municity->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->method('remove')
                                ->confirm(__('Once the municity is deleted, all of its resources and data will be permanently deleted.'))
                                ->parameters([
                                    'id' => $municity->id,
                                ]),
                        ]);
                }),
        ];
    }
}
