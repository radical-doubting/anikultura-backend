<?php

namespace App\Actions\FarmerReport;

use App\Models\Farmer\Farmer;
use App\Models\FarmerReport\FarmerReport;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class RetrieveFarmerSubmittedReports
{
    use AsAction;

    public function handle($farmer)
    {
        $farmlands = FarmerReport::with([
            'crop:id,name,slug',
            'verifier:id,first_name,middle_name,last_name',
            'seedStage:id,name,slug',
        ])
            ->where('reported_by', $farmer->id)
            ->orderBy('created_at', 'DESC')
            ->orderBy('seed_stage_id', 'DESC')
            ->get();

        return $farmlands->makeHidden([
            'updated_at',
            'farmland_id',
            'seed_stage_id',
            'reported_by',
            'crop_id',
            'verified_by',
            'image',
        ]);
    }

    /**
     * @OA\Get(
     *     path="/farmer-reports",
     *     description="Get the submitted farmer reports of the logged in farmer",
     *     tags={"farmer-reports"},
     *     @OA\Response(response="200", description="The submitted farmer reports", @OA\JsonContent()),
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
