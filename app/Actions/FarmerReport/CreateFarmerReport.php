<?php

namespace App\Actions\FarmerReport;

use App\Models\FarmerReport\FarmerReport;
use App\Traits\AsOrchidAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class CreateFarmerReport
{
    use AsAction;

    use AsOrchidAction;

    public function handle(FarmerReport $farmerReport, $farmerReportData)
    {
        $farmerReport
            ->fill($farmerReportData)
            ->save();
    }

    public function asOrchidAction($model, ?Request $request)
    {
        $farmerReportData = $request->get('farmer_report');

        $this->handle($model, $farmerReportData);

        Toast::info(__('Farmer report was saved successfully!'));

        return redirect()->route('platform.farmer-reports');
    }

    public function asController(ActionRequest $request)
    {
        $farmerReportData = $request->only('farmer_id', 'farmland_id', 'seed_stage_id', 'crop_id', 'volume');
        
        $this->handle($request->model(), $farmerReportData);
        
        return redirect()->route('platform.farmer-reports');
    }

    public function rules(): array
    {
        return [
            'farmer_report.farmer_id' => [
                'required',
            ],
            'farmer_report.farmland_id' => [
                'required',
            ],
            'farmer_report.seed_stage_id' => [
                'required',
            ],
            'farmer_report.crop_id' => [
                'required',
            ],
            'farmer_report.volume' => [
                'required',
            ],
        ];
    }
}
