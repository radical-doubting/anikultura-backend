<?php

namespace App\Actions\FarmerReport;

use App\Models\FarmerReport\FarmerReport;
use App\Traits\AsOrchidAction;
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

    /**
     * @OA\Post(
     *     path="/farmer-reports",
     *     description="Submit a farming report with current authenticated user",
     *     tags={"farmer-reports"},
     *     @OA\RequestBody(
     *       required=true,
     *       description="Pass farmer reports",
     *       @OA\JsonContent(
     *          required={"farmland_id", "seed_stage_id", "crop_id", "volume"},
     *          @OA\Property(property="farmland_id", type="bigint", format="bigint", example="4000"),
     *          @OA\Property(property="crop_id", type="bigint", format="bigint", example="2000"),
     *          @OA\Property(property="volume", type="double", format="double", example="1000"),
     *       ),
     *     ),
     *     @OA\Response(response="200", description="Successfuly crated a farmer report", @OA\JsonContent()),
     *     @OA\Response(response="422", description="Validation errors occured", @OA\JsonContent()),
     *     @OA\Response(response="401", description="Invalid request", @OA\JsonContent()),
     *     @OA\Response(response="400", description="Bad request. Id must be bigint.", @OA\JsonContent()),
     * )
     */
    public function asController(ActionRequest $request)
    {
        $farmerReportData = $request->only([
            'farmland_id',
            'crop_id',
            'volume',
        ]);

        $farmerReport = FarmerReport::create($farmerReportData);

        // $this->handle($request->model(), $farmerReportData);

        return response()->json();
    }

    public function rules(): array
    {
        return [
            'farmer_report.reported_by' => [
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
            'farmer_report.volume_kg' => [
                'required',
            ],
        ];
    }
}
