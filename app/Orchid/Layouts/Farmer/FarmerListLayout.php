<?php

namespace App\Orchid\Layouts\Farmer;

use App\Models\Farmer\FarmerProfile;
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

    protected $target = 'farmer_profiles';

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
                ->render(function (FarmerProfile $farmer_profile) {
                    return Link::make($farmer_profile->id)
                        ->route('platform.farmer.profile.edit', $farmer_profile->id);
                }),

            TD::make('lastname', __('Last Name'))
                ->cantHide()
                ->render(function (FarmerProfile $farmer_profile) {
                    return Link::make($farmer_profile->user->last_name)
                        ->route('platform.farmer.profile.edit', $farmer_profile->id);
                }),

            TD::make('firstname', __('First Name'))
                ->render(function (FarmerProfile $farmer_profile) {
                    return Link::make($farmer_profile->user->first_name)
                        ->route('platform.farmer.profile.edit', $farmer_profile->id);
                }),

            TD::make('middlename', __('Middle Name'))
                ->render(function (FarmerProfile $farmer_profile) {
                    return Link::make($farmer_profile->user->middle_name)
                        ->route('platform.farmer.profile.edit', $farmer_profile->id);
                }),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->cantHide()
                ->width('100px')
                ->render(function (FarmerProfile $farmer_profile) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Edit'))
                                ->route('platform.farmer.profile.edit', $farmer_profile->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->method('remove')
                                ->confirm(__('Once the farmer profile is deleted, all of its resources and data will be permanently deleted.'))
                                ->parameters([
                                    'id' => $farmer_profile->id,
                                ]),
                        ]);
                }),
        ];
    }
}
