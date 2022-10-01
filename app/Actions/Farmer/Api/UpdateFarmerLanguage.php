<?php

namespace App\Actions\Farmer\Api;

use App\Models\User\Farmer\Farmer;
use App\Traits\AsApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateFarmerLanguage
{
    use AsAction;
    use AsApiResponder;

    public function handle(Farmer $farmer, string $language): void
    {
        $farmer
            ->update([
                'locale' => $language,
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
        /**
         * @var Farmer
         */
        $farmer = auth('api')->user();

        $language = $request->get('language');

        $this->handle($farmer, $language);

        return $this->respondWithSuccess('Successfully updated language preference');
    }

    public function rules(): array
    {
        return [
            'language' => [
                'required',
                Rule::in(['en', 'fil_PH', 'ceb']),
            ],
        ];
    }
}
