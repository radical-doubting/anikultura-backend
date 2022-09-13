<?php

namespace App\Actions\FarmerReport;

use App\Actions\Crop\RetrieveFarmerSeedStage;
use App\Actions\Crop\RetrieveNextSeedStage;
use App\Http\Resources\FarmerReport\FarmerReportResource;
use App\Models\FarmerReport\FarmerReport;
use App\Models\Farmland\Farmland;
use Illuminate\Http\JsonResponse;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class SubmitFarmerReport
{
    use AsAction;

    public function handle($farmer, $farmerReportData)
    {
        $farmland = Farmland::findOrFail($farmerReportData['farmlandId']);
        $currentSeedStage = RetrieveFarmerSeedStage::run($farmer, $farmland);
        $nextSeedStage = RetrieveNextSeedStage::run($currentSeedStage);

        abort_if(is_null($nextSeedStage), 400, 'No next seed stage');

        $farmerReport = FarmerReport::create([
            'reported_by' => $farmer->id,
            'seed_stage_id' => $nextSeedStage->id,
            'farmland_id' => $farmland->id,
            'crop_id' => $farmerReportData['cropId'],
            'volume_kg' => $farmerReportData['volumeKg'],
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
     *             property="farmerReport",
     *             @OA\Property(property="farmlandId", type="int", format="int", example="1"),
     *             @OA\Property(property="cropId", type="int", format="int", example="1"),
     *             @OA\Property(property="volumeKg", type="double", format="double", example="10.23"),
     *          )
     *       ),
     *     ),
     *     @OA\Response(response="200", description="The created farmer report", @OA\JsonContent()),
     *     @OA\Response(response="422", description="Validation errors occured", @OA\JsonContent()),
     * )
     */
    public function asController(ActionRequest $request): JsonResponse
    {
        $farmer = auth('api')->user();

        $farmerReportData = $request->get('farmerReport');

        $createdFarmerReport = $this->handle($farmer, $farmerReportData);

        return response()->json(
            new FarmerReportResource(
                $createdFarmerReport->fresh()
            )
        );
    }

    public function rules(): array
    {
        return [
            'farmerReport.farmlandId' => [
                'required',
                'integer',
            ],
            'farmerReport.cropId' => [
                'required',
                'integer',
            ],
            'farmerReport.volumeKg' => [
                'numeric',
                'nullable',
            ],
        ];
    }
}
