<?php

namespace App\Actions\FarmerReport;

use App\Models\FarmerReport\FarmerReport;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;
use App\Events\ReadyForHarvestEvent;

class CreateFarmerReport
{
    use AsAction;
    use AsOrchidAction;

    public function handle(FarmerReport $farmerReport, array $farmerReportData): FarmerReport
    {
        $farmerReport
            ->fill($farmerReportData)
            ->save();
        
        if ($farmerReport->isHarvested() == true) {
            event(new ReadyForHarvestEvent($farmerReport));
        }

        return $farmerReport->refresh();
    }

    public function asOrchidAction(mixed $model, ?Request $request): RedirectResponse
    {
        $farmerReportData = $request->get('farmerReport');

        $this->handle($model, $farmerReportData);

        Toast::info(__('Farmer report was saved successfully!'));

        return redirect()->route('platform.farmer-reports');
    }

    public function rules(): array
    {
        return [
            'farmerReport.reported_by' => [
                'required',
            ],
            'farmerReport.farmland_id' => [
                'required',
            ],
            'farmerReport.seed_stage_id' => [
                'required',
            ],
            'farmerReport.crop_id' => [
                'required',
            ],
            'farmerReport.volume_kg' => [
                'numeric',
                'nullable',
            ],
        ];
    }
}
