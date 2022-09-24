<?php

namespace App\Actions\FarmerReport\Api;

use App\Models\FarmerReport\FarmerReport;
use Exception;
use Illuminate\Http\JsonResponse;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class UploadImageToFarmerReport
{
    use AsAction;

    public function __construct(
        protected ValidateSeedStage $validateSeedStage
    ) {
    }

    public function handle(FarmerReport $farmerReport, array $imageFile): void
    {
        $this->validateSeedStage->handle(
            $farmerReport->farmer,
            $farmerReport->farmland
        );

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
        $farmerReportId = $request->route('farmerReportId');

        $farmerReport = FarmerReport::findOrFail($farmerReportId);

        $imageFile = $request->file('image');

        try {
            $this->handle($farmerReport, $imageFile);

            return response()->json(
                ['message' => 'Succesfully uploaded']
            );
        } catch (Exception $exception) {
            return abort(400, $exception->getMessage());
        }
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
