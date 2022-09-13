<?php

namespace App\Orchid\Layouts\Crop;

use App\Models\Crop\Crop;
use App\Orchid\Layouts\AnikulturaListLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\TD;

class CropListLayout extends AnikulturaListLayout
{
    protected function columns(): iterable
    {
        return [
            TD::make('name', __('Name of Crop'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Crop $crop) {
                    return Link::make($crop->name)
                        ->route('platform.crops.edit', [$crop->id]);
                }),
            TD::make('group', __('Group'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Crop $crop) {
                    return Link::make($crop->group)
                        ->route('platform.crops.edit', [$crop->id]);
                }),
            TD::make('variety', __('Variety'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Crop $crop) {
                    return Link::make($crop->variety)
                        ->route('platform.crops.edit', [$crop->id]);
                }),
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Crop $crop) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.crops.edit', [$crop->id])
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->method('remove')
                                ->confirm(__('Once the crop is deleted, all of its resources and data will be permanently deleted.'))
                                ->parameters([
                                    'id' => $crop->id,
                                ]),
                        ]);
                }),
        ];
    }
}
