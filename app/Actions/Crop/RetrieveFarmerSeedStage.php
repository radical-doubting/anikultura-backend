<?php

namespace App\Actions\Crop;

use App\Http\Resources\Crop\SeedStageResource;
use App\Models\Crop\SeedStage;
use App\Models\Farmer\Farmer;
use App\Models\FarmerReport\FarmerReport;
use App\Models\Farmland\Farmland;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class RetrieveFarmerSeedStage
{
    use AsAction;

    public function handle($farmer, $farmland)
    {
        Farmer::query()->whereHas('farmlands', function ($q) use ($farmland) {
            $q->where('id', $farmland->id);
        })->findOrFail($farmer->id);

        $farmerReport = FarmerReport::orderBy('seed_stage_id', 'DESC')
            ->where('reported_by', $farmer->id)
            ->where('farmland_id', $farmland->id)
            ->first();

        $currentSeedStage = is_null($farmerReport) ?
            $this->getFirstSeedStage() : $farmerReport->seedStage;

        return $currentSeedStage;
    }

    private function getFirstSeedStage()
    {
        return SeedStage::where('slug', 'starter-kit-received')
            ->first();
    }

    /**
     * @OA\Post(
     *     path="/crops/seed-stage",
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
    public function asController(ActionRequest $request)
    {
        $user = auth('api')->user();

        $farmlandId = $request->get('farmlandId');
        $farmland = Farmland::findOrFail($farmlandId);

        $currentSeedStage = $this->handle($user, $farmland);

        return response()->json(new SeedStageResource($currentSeedStage));
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
