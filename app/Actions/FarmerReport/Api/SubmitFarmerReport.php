<?php

namespace App\Actions\FarmerReport\Api;

use App\Http\Resources\FarmerReport\FarmerReportResource;
use App\Models\Farmer\Farmer;
use App\Models\FarmerReport\FarmerReport;
use App\Models\Farmland\Farmland;
use Exception;
use Illuminate\Http\JsonResponse;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class SubmitFarmerReport
{
    use AsAction;

    public function __construct(
        protected ValidateSeedStage $validateSeedStage
    ) {
    }

    public function handle(Farmer $farmer, array $farmerReportData): FarmerReport
    {
        $farmland = Farmland::findOrFail($farmerReportData['farmlandId']);

        $nextSeedStage = $this->validateSeedStage->handle(
            $farmer,
            $farmland
        );

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
        /**
         * @var Farmer
         */
        $farmer = auth('api')->user();

        $farmerReportData = $request->get('farmerReport');

        try {
            $createdFarmerReport = $this->handle($farmer, $farmerReportData);

            return response()->json(
                new FarmerReportResource(
                    $createdFarmerReport->fresh()
                )
            );
        } catch (Exception $exception) {
            return abort(400, $exception->getMessage());
        }
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
