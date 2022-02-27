<?php

namespace App\Actions\Farmer;

use App\Models\Farmer\FarmerProfile;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateFarmerTutorialState
{
    use AsAction;

    public function handle(FarmerProfile $farmerProfile, bool $tutorialDone)
    {
        $farmerProfile->update(['tutorial_done' => $tutorialDone]);
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
    public function asController(ActionRequest $request)
    {
        $user = auth('api')->user();

        $tutorialDone = $request->get('tutorialDone');

        $this->handle($user->profile, $tutorialDone);

        return response()->json(['message' => 'Successfully updated tutorial state']);
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
