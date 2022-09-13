<?php

namespace App\Actions\FarmerReport;

use App\Actions\Crop\RetrieveFarmerSeedStage;
use App\Actions\Crop\RetrieveNextSeedStage;
use App\Models\FarmerReport\FarmerReport;
use Illuminate\Http\JsonResponse;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class UploadImageToFarmerReport
{
    use AsAction;

    public function handle(FarmerReport $farmerReport, $imageFile)
    {
        $farmer = $farmerReport->farmer;
        $farmland = $farmerReport->farmland;

        $currentSeedStage = RetrieveFarmerSeedStage::run($farmer, $farmland);
        $nextSeedStage = RetrieveNextSeedStage::run($currentSeedStage);

        abort_if(is_null($nextSeedStage), 400, 'No next seed stage');

        $farmerReport->attachMedia($imageFile);
    }

    /**
     * @OA\Post(
     *     path="/farmer-reports/{farmerReportId}/upload",
     *     description="Upload an image to farmer report",
     *     tags={"farmer-reports"},
     *     @OA\Parameter(
     *        name="farmerReportId",
     *        in="path",
     *        required=true,
     *     ),
     *     @OA\RequestBody(
     *       required=true,
     *        @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     description="proof image to upload",
     *                     property="image",
     *                     type="file",
     *                ),
     *                 required={"image"}
     *             )
     *         )
     *     ),
     *     @OA\Response(response="200", description="Upload success", @OA\JsonContent()),
     *     @OA\Response(response="422", description="Validation errors occured", @OA\JsonContent()),
     * )
     */
    public function asController(ActionRequest $request): JsonResponse
    {
        $farmer = auth('api')->user();

        $farmerReportId = $request->route('farmerReportId');

        $farmerReport = FarmerReport::findOrFail($farmerReportId);

        $imageFile = $request->file('image');

        $this->handle($farmerReport, $imageFile);

        return response()->json(
            ['message' => 'Succesfully uploaded']
        );
    }

    public function rules(): array
    {
        return [
            'image' => [
                'mimes:jpeg,jpg,bmp,png',
                'max:10240',
            ],
        ];
    }
}
