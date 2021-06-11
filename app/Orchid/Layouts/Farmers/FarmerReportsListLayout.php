<?php

namespace App\Orchid\Layouts\Farmers;

use App\Models\farmer_reports;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class FarmerReportsListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'farmer_reports';

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
            ->render(function (farmer_reports $farmer_reports) {
                return Link::make($farmer_reports->id)
                    ->route('platform.farmer.reports', $farmer_reports->id); 
            }),
            TD::make('farmer_profiles_id', __('Farmer Profiles ID'))
            ->sort()
            ->cantHide()
            ->filter(TD::FILTER_TEXT)
            ->render(function (farmer_reports $farmer_reports) {
                return Link::make($farmer_reports->id)
                    ->route('platform.farmer.reports', $farmer_reports->id); 
            }),
            TD::make('seed_stages_id', __('Seed Stages ID'))
            ->sort()
            ->cantHide()
            ->filter(TD::FILTER_TEXT)
            ->render(function (farmer_reports $farmer_reports) {
                return Link::make($farmer_reports->id)
                    ->route('platform.farmer.reports', $farmer_reports->id); 
            }),
            TD::make('farmland_id', __('Farmland ID'))
            ->sort()
            ->cantHide()
            ->filter(TD::FILTER_TEXT)
            ->render(function (farmer_reports $farmer_reports) {
                return Link::make($farmer_reports->id)
                    ->route('platform.farmer.reports', $farmer_reports->id); 
            }),
            TD::make('crop_id', __('Crop ID'))
            ->sort()
            ->cantHide()
            ->filter(TD::FILTER_TEXT)
            ->render(function (farmer_reports $farmer_reports) {
                return Link::make($farmer_reports->id)
                    ->route('platform.farmer.reports', $farmer_reports->id); 
            }),
            TD::make('volume', __('Volume'))
            ->sort()
            ->cantHide()
            ->filter(TD::FILTER_TEXT)
            ->render(function (farmer_reports $farmer_reports) {
                return Link::make($farmer_reports->id)
                    ->route('platform.farmer.reports', $farmer_reports->id); 
            })
        ];
    }
}
