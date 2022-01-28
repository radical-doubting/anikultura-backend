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

    //PROXYYYY PALANG TOH HAHAHAH di ko pa alam ano ilalagay hehehe
    /**
     * @OA\Post(
     *     path="/create.farmer.report",
     *     description="Gets farmer report data",
     *     tags={"farmer_reports"},
     *     @OA\RequestBody(
     *       required=true,
     *       description="Pass user credentials",
     *       @OA\JsonContent(
     *          required={"email","password"},
     *          @OA\Property(property="username", type="string", format="string", example="user1"),
     *          @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *       ),
     *     ),
     *     @OA\Response(response="200", description="Successful login with returned authentication token", @OA\JsonContent()),
     *     @OA\Response(response="422", description="Validation errors occured", @OA\JsonContent()),
     *     @OA\Response(response="401", description="Invalid login credentials", @OA\JsonContent()),
     *     @OA\Response(response="400", description="Already logged in", @OA\JsonContent()),
     * )
     */
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
