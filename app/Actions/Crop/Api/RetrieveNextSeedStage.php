<?php

namespace App\Actions\Crop\Api;

use App\Http\Resources\Crop\SeedStageResource;
use App\Models\Crop\SeedStage;
use App\Models\User\Farmer\Farmer;
use App\Models\Farmland\Farmland;
use Illuminate\Http\JsonResponse;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class RetrieveNextSeedStage
{
    use AsAction;

    public function __construct(
        protected RetrieveCurrentSeedStage $retrieveCurrentSeedStage
    ) {
    }

    public function handle(?SeedStage $currentSeedStage): ?SeedStage
    {
        if (is_null($currentSeedStage)) {
            return SeedStage::initialStage();
        } else {
            return $currentSeedStage->nextStage();
        }
    }

    /**
     * @OA\Post(
     *     path="/crops/next-seed-stage",
     *     description="Get the next seed stage of the logged in farmer",
     *     tags={"crops"},
     *     @OA\RequestBody(
     *       required=true,
     *       @OA\JsonContent(
     *         @OA\Property(property="farmlandId", type="int", format="int", example="1"),
     *       )
     *     ),
     *     @OA\Response(response="200", description="The next seed stage", @OA\JsonContent()),
     *     @OA\Response(response="401", description="Unauthenticated", @OA\JsonContent()),
     * )
     */
    public function asController(ActionRequest $request): JsonResponse|SeedStageResource
    {
        /**
         * @var Farmer
         */
        $farmer = auth('api')->user();

        $farmlandId = $request->get('farmlandId');
        $farmland = Farmland::findOrFail($farmlandId);

        $currentSeedStage = $this->retrieveCurrentSeedStage->handle(
            $farmer,
            $farmland
        );

        $nextSeedStage = $this->handle($currentSeedStage);

        if (is_null($nextSeedStage)) {
            return response()->json(null);
        } else {
            return SeedStageResource::make($nextSeedStage);
        }
    }

    public function rules(): array
    {
        return [
            'farmlandId' => [
                'required',
                'integer',
                'exists:farmlands,id',
            ],
        ];
    }
}
