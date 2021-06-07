<?php

namespace App\Orchid\Layouts\Farmland;

use App\Models\Farmland;
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
    protected $target = 'farmland';

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
                ->render(function (Farmland $farmland) {
                    return Link::make($farmland->id)
                        ->route('platform.farmer.farmland.edit', $farmland->id);
                }),

            TD::make('hectares_size', __('Farm Size'))
            ->sort()
            ->cantHide()
            ->filter(TD::FILTER_TEXT)
            ->render(function (Farmland $farmland) {
                return Link::make($farmland->lastname)
                    ->route('platform.farmer.farmland.edit', $farmland->id);
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
                                ->route('platform.farmer.farmland.edit', $farmland->id)
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
