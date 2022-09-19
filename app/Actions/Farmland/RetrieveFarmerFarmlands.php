<?php

namespace App\Actions\Farmland;

use App\Http\Resources\Farmland\FarmlandResource;
use App\Models\Farmer\Farmer;
use App\Models\Farmland\Farmland;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class RetrieveFarmerFarmlands
{
    use AsAction;

    public function handle($farmer)
    {
        $farmlands = Farmland::whereHas('farmers', function ($q) use ($farmer) {
            $q->where('farmer_id', $farmer->id);
        })->get(['id', 'name', 'hectares_size']);

        return $farmlands;
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
    public function asController(ActionRequest $request)
    {
        $user = auth('api')->user();

        $farmlands = $this->handle($user);

        return response()->json(FarmlandResource::collection($farmlands));
    }
}
