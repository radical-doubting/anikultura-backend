<?php

namespace App\Actions\Farmer\Api;

use App\Models\Farmer\FarmerProfile;
use App\Traits\AsApiResponder;
use Illuminate\Http\JsonResponse;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateFarmerTutorialState
{
    use AsAction;
    use AsApiResponder;

    public function handle(FarmerProfile $farmerProfile, bool $tutorialDone): void
    {
        $farmerProfile
            ->preference
            ->update([
                'tutorial_done' => $tutorialDone,
            ]);
    }

    /**
     * @OA\Patch(
     *     path="/farmers/tutorial",
     *     description="Update the tutorial state of the logged in farmer",
     *     tags={"farmers"},
     *     @OA\RequestBody(
     *       required=true,
     *       @OA\JsonContent(
     *         @OA\Property(property="tutorialDone", type="boolean", example="false"),
     *       )
     *     ),
     *     @OA\Response(response="200", description="Successful update", @OA\JsonContent()),
     *     @OA\Response(response="401", description="Unauthenticated", @OA\JsonContent()),
     * )
     */
    public function asController(ActionRequest $request): JsonResponse
    {
        $user = auth('api')->user();

        $tutorialDone = $request->get('tutorialDone');

        $this->handle($user->profile, $tutorialDone);

        return $this->respondWithSuccess('Successfully updated tutorial state');
    }

    public function rules(): array
    {
        return [
            'tutorialDone' => [
                'required',
                'boolean',
            ],
        ];
    }
}
