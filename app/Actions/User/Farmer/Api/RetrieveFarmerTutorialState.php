<?php

namespace App\Actions\Farmer\Api;

use App\Http\Resources\Farmer\TutorialStateResource;
use App\Models\User\Farmer\FarmerPreference;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class RetrieveFarmerTutorialState
{
    use AsAction;

    public function handle(FarmerPreference $farmerPreference): bool
    {
        return $farmerPreference->tutorial_done;
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
    public function asController(ActionRequest $request): TutorialStateResource
    {
        $user = auth('api')->user();

        $farmerPreference = $user->profile->preference;

        $this->handle($farmerPreference);

        return new TutorialStateResource($farmerPreference);
    }
}
