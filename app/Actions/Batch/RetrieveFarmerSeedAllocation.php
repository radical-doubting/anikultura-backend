<?php

namespace App\Actions\Batch;

use App\Models\Batch\BatchSeedAllocation;
use App\Models\Farmer\Farmer;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class RetrieveFarmerSeedAllocation
{
    use AsAction;

    public function handle($farmer)
    {
        $seedAllocations = BatchSeedAllocation::with([
            'batch:id,farmschool_name',
            'crop:id,name,slug',
        ])->where('farmer_id', $farmer->id)->get();

        return $seedAllocations->makeHidden([
            'created_at',
            'updated_at',
            'farmer_id',
            'batch_id',
            'crop_id',
        ]);
    }

    /**
     * @OA\Get(
     *     path="/crops/seed-allocation",
     *     description="Get the allocated seeds of the logged in farmer",
     *     tags={"crops"},
     *     @OA\Response(response="200", description="The allocated seeds", @OA\JsonContent()),
     *     @OA\Response(response="401", description="Unauthenticated", @OA\JsonContent()),
     * )
     */
    public function asController(ActionRequest $request)
    {
        $user = auth('api')->user();

        $seedAllocations = $this->handle($user);

        return response()->json($seedAllocations);
    }
}
