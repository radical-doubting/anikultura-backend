<?php

namespace App\Actions\Crop\Api;

use App\Http\Resources\Crop\SeedStageResource;
use App\Models\Crop\SeedStage;
use App\Models\Farmer\Farmer;
use App\Models\FarmerReport\FarmerReport;
use App\Models\Farmland\Farmland;
use Exception;
use Illuminate\Http\JsonResponse;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class RetrieveCurrentSeedStage
{
    use AsAction;

    public function handle(Farmer $farmer, Farmland $farmland): ?SeedStage
    {
        $this->validateFarmerBelongingToFarmland($farmer, $farmland);

        $farmerReport = FarmerReport::orderBy('seed_stage_id', 'DESC')
            ->where('reported_by', $farmer->id)
            ->where('farmland_id', $farmland->id)
            ->first();

        return $this->getCurrentSeedStage($farmerReport);
    }

    private function validateFarmerBelongingToFarmland(
        Farmer $farmer,
        Farmland $farmland
    ): void {
        $query = Farmer::query()->whereHas(
            'farmlands',
            fn ($q) => $q->where('id', $farmland->id)
        );

        $farmer = $query->find($farmer->id);

        if (is_null($farmer)) {
            throw new Exception('Farmer does not belong to farmland');
        }
    }

    private function getCurrentSeedStage(?FarmerReport $farmerReport): ?SeedStage
    {
        return is_null($farmerReport) ? null : $farmerReport->seedStage;
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
    public function asController(ActionRequest $request): JsonResponse|SeedStageResource
    {
        /**
         * @var Farmer
         */
        $farmer = auth('api')->user();

        $farmlandId = $request->get('farmlandId');
        $farmland = Farmland::findOrFail($farmlandId);

        $currentSeedStage = $this->handle($farmer, $farmland);

        if (is_null($currentSeedStage)) {
            return response()->json(null);
        } else {
            return SeedStageResource::make($currentSeedStage);
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
