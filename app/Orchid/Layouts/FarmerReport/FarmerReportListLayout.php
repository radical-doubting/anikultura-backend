<?php

namespace App\Orchid\Layouts\FarmerReport;

use App\Models\FarmerReport\FarmerReport;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class FarmerReportListLayout extends Table
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
            TD::make('farmer', __('Farmer'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (FarmerReport $farmer_report) {
                    return Link::make($farmer_report->farmer->fullName)
                        ->route('platform.farmer-reports.edit', $farmer_report->id);
                }),

            TD::make('seed_stage', __('Seed Stage'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (FarmerReport $farmer_report) {
                    return Link::make($farmer_report->seedStage->name)
                        ->route('platform.farmer-reports.edit', $farmer_report->id);
                }),

            TD::make('crop', __('Crop'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (FarmerReport $farmer_report) {
                    return Link::make($farmer_report->crop->name)
                        ->route('platform.farmer-reports.edit', $farmer_report->id);
                }),

            TD::make('volume', __('Volume (kg)'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (FarmerReport $farmer_report) {
                    return Link::make($farmer_report->volume_kg)
                        ->route('platform.farmer-reports.edit', $farmer_report->id);
                }),

            TD::make('created_at', __('Reported at'))
                ->sort()
                ->render(function (FarmerReport $farmer_report) {
                    return $farmer_report->created_at->toDateTimeString();
                }),
        ];
    }
}
