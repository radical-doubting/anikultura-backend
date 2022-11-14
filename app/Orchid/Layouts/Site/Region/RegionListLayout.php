<?php

namespace App\Orchid\Layouts\Site\Region;

use App\Models\Site\Region;
use App\Orchid\Layouts\AnikulturaListLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\TD;

class RegionListLayout extends AnikulturaListLayout
{
    protected $target = 'regions';

    protected function columns(): array
    {
        return [
            TD::make('name', __('Name'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Region $region) {
                    return Link::make($region->fullName)
                        ->route('platform.sites.regions.edit', [$region->id]);
                }),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->cantHide()
                ->width('100px')
                ->render(function (Region $region) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Edit'))
                                ->route('platform.sites.regions.edit', [$region->id])
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->method('remove')
                                ->confirm(__('Once the region is deleted, all of its resources and data will be permanently deleted.'))
                                ->parameters([
                                    'id' => $region->id,
                                ]),
                        ]);
                }),
        ];
    }
}
