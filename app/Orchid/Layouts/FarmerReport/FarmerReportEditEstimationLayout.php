<?php

namespace App\Orchid\Layouts\FarmerReport;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class FarmerReportEditEstimationLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
        $currentReport = $this->query['farmer_report'];
        $isPlanted = false;

        if ($currentReport->exists) {
            $farmland = $currentReport->farmland;
            $farmlandName = $farmland->name;
            $farmlandHectares = $farmland->hectares;

            $cropName = $currentReport->crop->name;
            $isPlanted = $currentReport->isPlanted();

            $disclaimer = __("The estimated yield assuming that the entire $farmlandHectares hectare(s) of $farmlandName has only $cropName planted.");
        }

        return [
            Input::make('farmer_report.estimated_yield_amount')
                ->readonly()
                ->style('color: black')
                ->title($isPlanted ? __('Estimated Yield Amount (kg)') : '')
                ->placeholder(__('Estimated Yield Amount (kg)'))
                ->help($isPlanted ? $disclaimer : 'Estimation data is available when this report reaches the Seeds Planted stage.')
                ->hidden(! $isPlanted)
                ->mask([
                    'alias' => 'currency',
                    'suffix' => ' kg',
                    'groupSeparator' => ',',
                    'digitsOptional' => false,
                    'removeMaskOnSubmit' => true,
                ]),

            Group::make([
                Input::make('farmer_report.estimated_yield_date_lower_bound')
                    ->type('date')
                    ->readonly()
                    ->style('color: black')
                    ->title($isPlanted ? __('Estimated Yield Date (Earliest)') : '')
                    ->placeholder(__('Estimated Yield Amount (Earliest)'))
                    ->help($isPlanted ? __('The earliest date that this crop could reach maturity.') : '')
                    ->hidden(! $isPlanted),

                Input::make('farmer_report.estimated_yield_date_upper_bound')
                    ->type('date')
                    ->readonly()
                    ->style('color: black')
                    ->title($isPlanted ? __('Estimated Yield Date (Latest)') : '')
                    ->placeholder(__('Estimated Yield Amount (Latest)'))
                    ->help($isPlanted ? __('The latest date that this crop could reach maturity.') : '')
                    ->hidden(! $isPlanted),
            ]),
        ];
    }
}
