<?php

namespace App\Actions\Crop;

use App\Models\Crop\SeedStage;
use App\Models\Farmer\Farmer;
use App\Models\FarmerReport\FarmerReport;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class RetrieveFarmerSeedStage
{
    use AsAction;

    public function handle($farmer)
    {
        $farmerReport = FarmerReport::orderBy('seed_stage_id', 'DESC')
            ->where('reported_by', $farmer->id)
            ->first();

        $currentSeedStage = is_null($farmerReport) ?
            $this->getFirstSeedStage() : $farmerReport->seedStage;

        return $currentSeedStage->makeHidden('created_at', 'updated_at');
    }

    private function getFirstSeedStage()
    {
        return SeedStage::where('slug', 'starter-kit-received')
            ->first();
    }

    /**
     * @OA\Get(
     *     path="/crops/seed-stage",
     *     description="Get the current seed stage of the logged in farmer",
     *     tags={"crops"},
     *     @OA\Response(response="200", description="The current seed stage", @OA\JsonContent()),
     *     @OA\Response(response="401", description="Unauthenticated", @OA\JsonContent()),
     * )
     */
    public function asController(ActionRequest $request)
    {
        $user = auth('api')->user();

        $currentSeedStage = $this->handle($user);

        return response()->json($currentSeedStage);
    }
}
