<?php

namespace App\Actions\Crop;

use App\Http\Resources\Crop\SeedStageResource;
use App\Models\Farmer\Farmer;
use App\Models\FarmerReport\FarmerReport;
use App\Models\Farmland\Farmland;
use Illuminate\Http\JsonResponse;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class RetrieveFarmerSeedStage
{
    use AsAction;

    public function handle($farmer, Farmland $farmland)
    {
        Farmer::query()->whereHas('farmlands', function ($q) use ($farmland) {
            $q->where('id', $farmland->id);
        })->findOrFail($farmer->id);

        $farmerReport = FarmerReport::orderBy('seed_stage_id', 'DESC')
            ->where('reported_by', $farmer->id)
            ->where('farmland_id', $farmland->id)
            ->first();

        $currentSeedStage = is_null($farmerReport) ?
            null : $farmerReport->seedStage;

        return $currentSeedStage;
    }

    /**
     * @OA\Post(
     *     path="/crops/current-seed-stage",
     *     description="Get the current seed stage of the logged in farmer",
     *     tags={"crops"},
     *     @OA\RequestBody(
     *       required=true,
     *       @OA\JsonContent(
     *         @OA\Property(property="farmlandId", type="int", format="int", example="1"),
     *       )
     *     ),
     *     @OA\Response(response="200", description="The current seed stage", @OA\JsonContent()),
     *     @OA\Response(response="401", description="Unauthenticated", @OA\JsonContent()),
     * )
     */
    public function asController(ActionRequest $request): JsonResponse
    {
        $user = auth('api')->user();

        $farmlandId = $request->get('farmlandId');
        $farmland = Farmland::findOrFail($farmlandId);

        $currentSeedStage = $this->handle($user, $farmland);

        if (is_null($currentSeedStage)) {
            return response()->json(null);
        } else {
            return response()->json(new SeedStageResource($currentSeedStage));
        }
    }

    public function rules(): array
    {
        return [
            'farmlandId' => [
                'required',
                'integer',
            ],
        ];
    }
}
