<?php

namespace App\Actions\Farmland\Api;

use App\Http\Resources\Farmland\FarmlandResource;
use App\Models\User\Farmer\Farmer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class RetrieveFarmerFarmlands
{
    use AsAction;

    public function handle(Farmer $farmer): Collection
    {
        return $farmer->farmlands;
    }

    /**
     * @OA\Get(
     *     path="/farmlands",
     *     description="Get the associated farmlands of the logged in farmer",
     *     tags={"farmlands"},
     *     @OA\Response(response="200", description="The associated farmlands", @OA\JsonContent()),
     *     @OA\Response(response="401", description="Unauthenticated", @OA\JsonContent()),
     * )
     */
    public function asController(ActionRequest $request): AnonymousResourceCollection
    {
        $user = auth('api')->user();

        $farmlands = $this->handle($user);

        return FarmlandResource::collection($farmlands);
    }
}
