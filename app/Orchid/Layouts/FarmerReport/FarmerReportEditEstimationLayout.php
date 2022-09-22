<?php

namespace App\Orchid\Layouts\FarmerReport;

use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;

class FarmerReportEditEstimationLayout extends AnikulturaEditLayout
{
    protected function fields(): iterable
    {
        $currentReport = $this->query->get('farmerReport');
        $isPlanted = false;
        $disclaimer = __('Estimation data is available when this report reaches the Seeds Planted stage.');

        if ($currentReport->exists) {
            $farmland = $currentReport->farmland;
            $farmlandName = $farmland->name;
            $farmlandHectares = $farmland->hectares;

            $cropName = $currentReport->crop->name;
            $isPlanted = $currentReport->isPlanted();

            if ($isPlanted) {
                $disclaimer = __("The estimated yield assuming that the entire $farmlandHectares hectare(s) of $farmlandName has only $cropName planted.");
            }
        }

        return [
            Input::make('farmerReport.estimated_yield_amount')
                ->title($isPlanted ? __('Estimated Yield Amount (kg)') : '')
                ->readonly()
                ->mask([
                    'alias' => 'currency',
                    'suffix' => ' kg',
                    'groupSeparator' => ',',
                    'digitsOptional' => false,
                    'removeMaskOnSubmit' => true,
                ])
                ->help($disclaimer)
                ->style('color: black')
                ->hidden(! $isPlanted),

            Group::make([
                Input::make('farmerReport.estimated_yield_date_lower_bound')
                    ->title($isPlanted ? __('Estimated Yield Date (Earliest)') : '')
                    ->type('date')
                    ->readonly()
                    ->help($isPlanted ? __('The earliest date that this crop could reach maturity.') : '')
                    ->style('color: black')
                    ->hidden(! $isPlanted),
                Input::make('farmerReport.estimated_yield_date_upper_bound')
                    ->title($isPlanted ? __('Estimated Yield Date (Latest)') : '')
                    ->type('date')
                    ->readonly()
                    ->help($isPlanted ? __('The latest date that this crop could reach maturity.') : '')
                    ->style('color: black')
                    ->hidden(! $isPlanted),
            ]),
        ];
    }
}
