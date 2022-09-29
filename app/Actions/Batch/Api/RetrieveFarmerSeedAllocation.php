<?php

namespace App\Actions\Batch\Api;

use App\Http\Resources\Batch\BatchSeedAllocationResource;
use App\Models\Farmer\Farmer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class RetrieveFarmerSeedAllocation
{
    use AsAction;

    public function handle(Farmer $farmer): Collection
    {
        return $farmer->seedAllocations;
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
    public function asController(ActionRequest $request): AnonymousResourceCollection
    {
        /**
         * @var Farmer
         */
        $user = auth('api')->user();

        $seedAllocations = $this->handle($user);

        return BatchSeedAllocationResource::collection($seedAllocations);
    }
}
