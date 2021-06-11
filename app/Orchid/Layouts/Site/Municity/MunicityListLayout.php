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
                ->render(function (Municity $municity) {
                    $province = $municity->province;
                    $has_province = !is_null($province);
                    $element = $has_province ? Link::make($province->name)
                        ->route('platform.sites.provinces.edit', $province->id) : __('None');

                    return $element;
                }),

            TD::make('region', __('Region'))
                ->render(function (Municity $municity) {
                    $region = $municity->region;
                    $has_region = !is_null($region);
                    $element = $has_region ? Link::make($region->name)
                        ->route('platform.sites.regions.edit', $region->id) : __('None');

                    return $element;
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
