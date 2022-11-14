<?php

namespace App\Actions\Crop\Api;

use App\Http\Resources\Crop\CropResource;
use App\Models\User\Farmer\Farmer;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class RetrieveFarmerCrops
{
    use AsAction;

    public function handle(Farmer $farmer): Collection
    {
        return $farmer->seedAllocations->pluck('crop')->unique();
    }

    /**
     * @OA\Get(
     *     path="/crops",
     *     description="Get the current crops of the logged in farmer",
     *     tags={"crops"},
     *     @OA\Response(response="200", description="The current crops", @OA\JsonContent()),
     *     @OA\Response(response="401", description="Unauthenticated", @OA\JsonContent()),
     * )
     */
    public function asController(ActionRequest $request): AnonymousResourceCollection
    {
        /**
         * @var Farmer
         */
        $farmer = auth('api')->user();

        $crops = $this->handle($farmer);

        return CropResource::collection($crops);
    }
}
