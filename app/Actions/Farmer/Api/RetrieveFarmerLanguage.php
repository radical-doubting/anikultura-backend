<?php

namespace App\Actions\Farmer\Api;

use App\Http\Resources\Farmer\LanguageResource;
use App\Models\Farmer\FarmerPreference;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class RetrieveFarmerLanguage
{
    use AsAction;

    public function handle(FarmerPreference $farmerPreference): string
    {
        return $farmerPreference->language;
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
    public function asController(ActionRequest $request): LanguageResource
    {
        $user = auth('api')->user();

        $farmerPreference = $user->profile->preference;

        $this->handle($farmerPreference);

        return LanguageResource::make($farmerPreference);
    }
}
