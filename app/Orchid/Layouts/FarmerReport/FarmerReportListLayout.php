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
                ->render(function (FarmerReport $farmerReport) {
                    return Link::make($farmerReport->farmer->fullName)
                        ->route('platform.farmer-reports.edit', [$farmerReport->id]);
                }),
            TD::make('seed_stage', __('Seed Stage'))
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (FarmerReport $farmerReport) {
                    return Link::make($farmerReport->seedStage->name)
                        ->route('platform.farmer-reports.edit', [$farmerReport->id]);
                }),
            TD::make('crop', __('Crop'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (FarmerReport $farmerReport) {
                    return Link::make($farmerReport->crop->name)
                        ->route('platform.farmer-reports.edit', [$farmerReport->id]);
                }),
            TD::make('created_at', __('Reported at'))
                ->sort()
                ->render(function (FarmerReport $farmerReport) {
                    return $farmerReport->created_at->toDateTimeString();
                }),
        ];
    }
}
