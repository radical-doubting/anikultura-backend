<?php

namespace App\Actions\Farmer;

use App\Models\Farmer\FarmerProfile;
use Illuminate\Http\JsonResponse;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class RetrieveFarmerTutorialState
{
    use AsAction;

    public function handle(FarmerProfile $farmerProfile)
    {
        return $farmerProfile->tutorial_done;
    }

    /**
     * @OA\Get(
     *     path="/farmers/tutorial",
     *     description="Get the current tutorial state of the logged in farmer",
     *     tags={"farmers"},
     *     @OA\Response(response="200", description="The tutorial state", @OA\JsonContent()),
     *     @OA\Response(response="401", description="Unauthenticated", @OA\JsonContent()),
     * )
     */
    public function asController(ActionRequest $request): JsonResponse
    {
        $user = auth('api')->user();

        $isTutorialDone = $this->handle($user->profile);

        return response()->json(['isTutorialDone' => $isTutorialDone]);
    }
}
