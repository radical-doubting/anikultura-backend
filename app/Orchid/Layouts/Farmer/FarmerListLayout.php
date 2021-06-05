<?php

namespace App\Orchid\Layouts\Farmer;

use App\Models\Farmer_profile;
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
    protected $target = 'farmer_profile';

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
                ->render(function (Farmer_profile $farmer_profile) {
                    return Link::make($farmer_profile->id)
                        ->route('platform.farmer.profile.view.all', $farmer_profile->id);
                }),
            
            TD::make('lastname', __('Last Name'))
            ->sort()
            ->cantHide()
            ->filter(TD::FILTER_TEXT)
            ->render(function (Farmer_profile $farmer_profile) {
                return Link::make($farmer_profile->lastname)
                    ->route('platform.farmer.profile.view.all', $farmer_profile->lastname);
            }),

            TD::make('firstname', __('First Name'))
            ->sort()
            ->cantHide()
            ->filter(TD::FILTER_TEXT)
            ->render(function (Farmer_profile $farmer_profile) {
                return Link::make($farmer_profile->firstname)
                    ->route('platform.farmer.profile.view.all', $farmer_profile->firstname);
            }),

            TD::make('middlename', __('Middle Name'))
            ->sort()
            ->cantHide()
            ->filter(TD::FILTER_TEXT)
            ->render(function (Farmer_profile $farmer_profile) {
                return Link::make($farmer_profile->middlename)
                    ->route('platform.farmer.profile.view.all', $farmer_profile->middlename);
            }),
        ];
    }
}
