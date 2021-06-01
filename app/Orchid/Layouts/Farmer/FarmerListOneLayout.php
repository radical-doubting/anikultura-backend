<?php

namespace App\Orchid\Layouts\Farmer;

use App\Models\Farmer\Farmer_profile;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;

class FarmerListOneLayout extends Table
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
            TD::set('id', __('ID'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Farmer_profile $farmer_profile) {
                    return Link::make($farmer_profile->id)
                        ->route('platform.systems.farmer.profiles.list.one', $farmer_profile->id);
                }),
        ];
    }
}
