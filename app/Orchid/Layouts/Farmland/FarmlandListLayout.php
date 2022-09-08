<?php

namespace App\Orchid\Layouts\Farmland;

use App\Models\Farmland\Farmland;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class FarmlandListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'farmlands';

    /**
     * @return bool
     */
    protected function striped(): bool
    {
        return true;
    }

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
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
                                ->confirm(__("Once the farmer's farmland is deleted, all of its resources and data will be permanently deleted."))
                                ->parameters([
                                    'id' => $farmland->id,
                                ]),
                        ]);
                }),
        ];
    }
}
