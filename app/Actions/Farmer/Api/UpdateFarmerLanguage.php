<?php

namespace App\Actions\Farmer\Api;

use App\Models\Farmer\FarmerProfile;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateFarmerLanguage
{
    use AsAction;

    public function handle(FarmerProfile $farmerProfile, string $language): void
    {
        $farmerProfile
            ->preference
            ->update([
                'language' => $language,
            ]);
    }

    /**
     * @OA\Patch(
     *     path="/farmers/language",
     *     description="Update the language preference of the logged in farmer",
     *     tags={"farmers"},
     *     @OA\RequestBody(
     *       required=true,
     *       @OA\JsonContent(
     *         @OA\Property(property="language", type="string", example="en"),
     *       )
     *     ),
     *     @OA\Response(response="200", description="Successful update", @OA\JsonContent()),
     *     @OA\Response(response="401", description="Unauthenticated", @OA\JsonContent()),
     * )
     */
    public function asController(ActionRequest $request): JsonResponse
    {
        $user = auth('api')->user();

        $language = $request->get('language');

        $this->handle($user->profile, $language);

        return response()->json(['message' => 'Successfully updated language preference']);
    }

    public function rules(): array
    {
        return [
            'language' => [
                'required',
                Rule::in(['en', 'fil_PH']),
            ],
        ];
    }
}
