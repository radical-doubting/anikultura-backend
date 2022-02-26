<?php

namespace App\Actions\Crop;

use App\Http\Resources\Crop\SeedStageResource;
use App\Models\Crop\SeedStage;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class RetrieveNextSeedStage
{
    use AsAction;

    public function handle(SeedStage $currentSeedStage)
    {
        if ($currentSeedStage->slug === 'marketable') {
            return null;
        }

        return SeedStage::findOrFail($currentSeedStage->id + 1);
    }

    /**
     * @OA\Post(
     *     path="/crops/next-seed-stage",
     *     description="Get the next seed stage of of a given seed stage",
     *     tags={"crops"},
     *     @OA\RequestBody(
     *       required=true,
     *       @OA\JsonContent(
     *         @OA\Property(property="currentSeedStageId", type="int", format="int", example="1"),
     *       )
     *     ),
     *     @OA\Response(response="200", description="Next seed stage", @OA\JsonContent()),
     *     @OA\Response(response="401", description="Unauthenticated", @OA\JsonContent()),
     * )
     */
    public function asController(ActionRequest $request)
    {
        $currentSeedStageId = $request->get('currentSeedStageId');
        $currentSeedStage = SeedStage::findOrFail($currentSeedStageId);
        $nextSeedStage = $this->handle($currentSeedStage);

        if (is_null($nextSeedStage)) {
            return response()->json(null);
        } else {
            return response()->json(new SeedStageResource($nextSeedStage));
        }
    }

    public function rules(): array
    {
        return [
            'currentSeedStageId' => [
                'required',
                'integer',
            ],
        ];
    }
}
