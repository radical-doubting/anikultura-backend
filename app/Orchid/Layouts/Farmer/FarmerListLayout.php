<?php

namespace App\Orchid\Layouts\Farmer;

use App\Models\Farmer\Farmer;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class FarmerListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'farmers';

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
            TD::make('firstname', __('First Name'))
                ->render(function (Farmer $farmer) {
                    return Link::make($farmer->first_name)
                        ->route('platform.farmers.edit', $farmer->id);
                }),

            TD::make('middlename', __('Middle Name'))
                ->render(function (Farmer $farmer) {
                    return Link::make($farmer->middle_name)
                        ->route('platform.farmers.edit', $farmer->id);
                }),

            TD::make('lastname', __('Last Name'))
                ->cantHide()
                ->render(function (Farmer $farmer) {
                    return Link::make($farmer->last_name)
                        ->route('platform.farmers.edit', $farmer->id);
                }),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->cantHide()
                ->width('100px')
                ->render(function (Farmer $farmer) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Edit'))
                                ->route('platform.farmers.edit', $farmer->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->method('remove')
                                ->confirm(__('Once the farmer is deleted, all of its resources and data will be permanently deleted.'))
                                ->parameters([
                                    'id' => $farmer->id,
                                ]),
                        ]);
                }),
        ];
    }
}
