<?php

namespace App\Actions\Farmer\Api;

use App\Models\Farmer\FarmerProfile;
use Illuminate\Http\JsonResponse;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class RetrieveFarmerLanguage
{
    use AsAction;

    public function handle(FarmerProfile $farmerProfile): string
    {
        return $farmerProfile->preference->language;
    }

    /**
     * @OA\Get(
     *     path="/farmers/language",
     *     description="Get the current language preference of the logged in farmer",
     *     tags={"farmers"},
     *     @OA\Response(response="200", description="The language preference", @OA\JsonContent()),
     *     @OA\Response(response="401", description="Unauthenticated", @OA\JsonContent()),
     * )
     */
    public function asController(ActionRequest $request): JsonResponse
    {
        $user = auth('api')->user();

        $language = $this->handle($user->profile);

        return response()->json(['language' => $language]);
    }
}
