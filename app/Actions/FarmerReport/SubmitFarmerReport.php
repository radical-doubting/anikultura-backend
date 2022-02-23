<?php

namespace App\Actions\FarmerReport;

use App\Actions\Crop\RetrieveFarmerSeedStage;
use App\Models\FarmerReport\FarmerReport;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class SubmitFarmerReport
{
    use AsAction;

    public function handle($farmer, $farmerReportData)
    {
        $farmerReport = FarmerReport::create([
            'reported_by' => $farmer->id,
            'seed_stage_id' =>  $this->getNextSeedStage($farmer),
            'farmland_id' => $farmerReportData['farmland_id'],
            'crop_id' => $farmerReportData['crop_id'],
            'volume_kg' => $farmerReportData['volume_kg'],
        ]);

        return $farmerReport;
    }

    /**
     * @OA\Post(
     *     path="/farmer-reports",
     *     description="Submit a farming report with logged in farmer",
     *     tags={"farmer-reports"},
     *     @OA\RequestBody(
     *       required=true,
     *       @OA\JsonContent(
     *          @OA\Property(
     *             property="farmer_report",
     *             @OA\Property(property="farmland_id", type="int", format="int", example="1"),
     *             @OA\Property(property="crop_id", type="int", format="int", example="1"),
     *             @OA\Property(property="volume_kg", type="double", format="double", example="10.23"),
     *          )
     *       ),
     *     ),
     *     @OA\Response(response="200", description="The created farmer report", @OA\JsonContent()),
     *     @OA\Response(response="422", description="Validation errors occured", @OA\JsonContent()),
     * )
     */
    public function asController(ActionRequest $request)
    {
        $farmer = auth('api')->user();

        $farmerReportData = $request->get('farmer_report');

        $createdFarmerReport = $this->handle($farmer, $farmerReportData);

        return response()->json(
            $createdFarmerReport->fresh()
        );
    }

    private function getNextSeedStage($farmer)
    {
        $currentSeedStage = RetrieveFarmerSeedStage::run($farmer);

        if ($currentSeedStage->slug === 'marketable') {
            return $currentSeedStage->id;
        }

        return $currentSeedStage->id + 1;
    }

    public function rules(): array
    {
        return [
            'farmer_report.farmland_id' => [
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
