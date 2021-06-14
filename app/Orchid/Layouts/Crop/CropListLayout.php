<?php

namespace App\Orchid\Layouts\Crop;

use App\Models\Crop;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CropListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'crops';

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
                ->render(function (Crop $crop) {
                    return Link::make($crop->id)
                        ->route('platform.crops.edit', $crop->id);
                }),

            TD::make('group', __('Group'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Crop $crop) {
                    return Link::make($crop->group)
                        ->route('platform.crops.edit', $crop->id);
                }),

            TD::make('name', __('Name'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Crop $crop) {
                    return Link::make($crop->name)
                        ->route('platform.crops.edit', $crop->id);
                }),

            TD::make('variety', __('Variety'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Crop $crop) {
                    return Link::make($crop->variety)
                        ->route('platform.crops.edit', $crop->id);
                }),

            TD::make('establishment_days', __('Establishment Days'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Crop $crop) {
                    return Link::make($crop->establishment_days)
                        ->route('platform.crops.edit', $crop->id);
                }),

            TD::make('vegetative_days', __('Vegetative Days'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Crop $crop) {
                    return Link::make($crop->vegetative_days)
                        ->route('platform.crops.edit', $crop->id);
                }),

            TD::make('yield_formation_days', __('Yield Formation Days'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Crop $crop) {
                    return Link::make($crop->yield_formation_days)
                        ->route('platform.crops.edit', $crop->id);
                }),

            TD::make('ripening_days', __('Ripening Days'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Crop $crop) {
                    return Link::make($crop->ripening_days)
                        ->route('platform.crops.edit', $crop->id);
                }),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Crop $crop) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.crops.edit', $crop->id)
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
