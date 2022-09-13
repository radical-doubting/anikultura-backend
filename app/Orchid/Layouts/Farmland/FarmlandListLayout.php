<?php

namespace App\Orchid\Layouts\Farmland;

use App\Models\Farmland\Farmland;
use App\Orchid\Layouts\AnikulturaListLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\TD;

class FarmlandListLayout extends AnikulturaListLayout
{
    protected $target = 'farmlands';

    protected function columns(): iterable
    {
        return [
            TD::make('name', __('Name'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Farmland $farmland) {
                    return Link::make($farmland->name)
                        ->route('platform.farmlands.edit', $farmland->id);
                }),

            TD::make('batch_id', __('Batch'))
                ->render(function (Farmland $farmland) {
                    return Link::make($farmland->batch->farmschool_name)
                        ->route('platform.farmlands.edit', $farmland->id);
                }),

            TD::make('type', __('Type'))
                ->render(function (Farmland $farmland) {
                    return Link::make($farmland->type->name)
                        ->route('platform.farmlands.edit', $farmland->id);
                }),

            TD::make('status', __('Status'))
                ->render(function (Farmland $farmland) {
                    return Link::make($farmland->status->name)
                        ->route('platform.farmlands.edit', $farmland->id);
                }),

            TD::make('hectares_size', __('Size (ha)'))
                ->sort()
                ->render(function (Farmland $farmland) {
                    return Link::make($farmland->hectares_size)
                        ->route('platform.farmlands.edit', $farmland->id);
                }),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->cantHide()
                ->width('100px')
                ->render(function (Farmland $farmland) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Edit'))
                                ->route('platform.farmlands.edit', $farmland->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->method('remove')
                                ->confirm(__('Once the farmland is deleted, all of its resources and data will be permanently deleted.'))
                                ->parameters([
                                    'id' => $farmland->id,
                                ]),
                        ]);
                }),
        ];
    }
}
