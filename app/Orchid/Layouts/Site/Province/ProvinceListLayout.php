<?php

namespace App\Orchid\Layouts\Site\Province;

use App\Models\Site\Province;
use App\Orchid\Layouts\AnikulturaListLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\TD;

class ProvinceListLayout extends AnikulturaListLayout
{
    protected $target = 'provinces';

    protected function columns(): iterable
    {
        return [
            TD::make('name', __('Name'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Province $province) {
                    return Link::make($province->name)
                        ->route('platform.sites.provinces.edit', [$province->id]);
                }),

            TD::make('region', __('Region'))
                ->render(function (Province $province) {
                    return Link::make($province->region->fullName)
                        ->route('platform.sites.provinces.edit', [$province->id]);
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
                                ->route('platform.sites.provinces.edit', [$province->id])
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->method('remove')
                                ->confirm(__('Once the province is deleted, all of its resources and data will be permanently deleted.'))
                                ->parameters([
                                    'id' => $province->id,
                                ]),
                        ]);
                }),
        ];
    }
}
