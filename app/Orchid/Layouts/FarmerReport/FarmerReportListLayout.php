<?php

namespace App\Orchid\Layouts\FarmerReport;

use App\Models\FarmerReport\FarmerReport;
use App\Orchid\Layouts\AnikulturaListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\TD;

class FarmerReportListLayout extends AnikulturaListLayout
{
    protected $target = 'farmer_reports';

    protected function columns(): iterable
    {
        return [
            TD::make('farmer', __('Farmer'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (FarmerReport $farmer_report) {
                    return Link::make($farmer_report->farmer->fullName)
                        ->route('platform.farmer-reports.edit', [$farmer_report->id]);
                }),
            TD::make('seed_stage', __('Seed Stage'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (FarmerReport $farmer_report) {
                    return Link::make($farmer_report->seedStage->name)
                        ->route('platform.farmer-reports.edit', [$farmer_report->id]);
                }),
            TD::make('crop', __('Crop'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (FarmerReport $farmer_report) {
                    return Link::make($farmer_report->crop->name)
                        ->route('platform.farmer-reports.edit', [$farmer_report->id]);
                }),
            TD::make('created_at', __('Reported at'))
                ->sort()
                ->render(function (FarmerReport $farmer_report) {
                    return $farmer_report->created_at->toDateTimeString();
                }),
        ];
    }
}
