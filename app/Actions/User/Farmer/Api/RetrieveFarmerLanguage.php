<?php

namespace App\Actions\User\Farmer\Api;

use App\Http\Resources\Farmer\LanguageResource;
use App\Models\User\Farmer\Farmer;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class RetrieveFarmerLanguage
{
    use AsAction;

    public function handle(Farmer $farmer): string
    {
        return $farmer->preferredLocale();
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
        /**
         * @var Farmer
         */
        $farmer = auth('api')->user();

        $this->handle($farmer);

        return LanguageResource::make($farmer);
    }
}
