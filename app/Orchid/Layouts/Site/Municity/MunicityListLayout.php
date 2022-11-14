<?php

namespace App\Orchid\Layouts\Site\Municity;

use App\Models\Site\Municity;
use App\Orchid\Layouts\AnikulturaListLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\TD;

class MunicityListLayout extends AnikulturaListLayout
{
    protected $target = 'municities';

    protected function columns(): iterable
    {
        return [
            TD::make('name', __('Name'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Municity $municity) {
                    return Link::make($municity->name)
                        ->route('platform.sites.municities.edit', [$municity->id]);
                }),
            TD::make('province', __('Province'))
                ->render(function (Municity $municity) {
                    return Link::make($municity->province->name)
                        ->route('platform.sites.municities.edit', [$municity->id]);
                }),
            TD::make('region', __('Region'))
                ->render(function (Municity $municity) {
                    return Link::make($municity->region->fullName)
                        ->route('platform.sites.municities.edit', [$municity->id]);
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
                                ->route('platform.sites.municities.edit', [$municity->id])
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
