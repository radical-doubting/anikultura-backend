<?php

namespace App\Actions\Farmland;

use App\Models\Farmland\Farmland;
use App\Models\User\Farmer\Farmer;
use App\Models\User\User;
use App\Traits\AsOrchidAction;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class CreateFarmland
{
    use AsAction;
    use AsOrchidAction;

    public function handle(Farmland $farmland, array $farmlandData, User $user): Farmland
    {
        $farmland->fill($farmlandData);

        if ($user->isBigBrother()) {
            $this->validateIfBigBrotherBelongsToBatch($farmland, $user);
        }

        $farmland->save();

        $farmland
            ->wateringSystems()
            ->sync($farmlandData['wateringSystems']);

        $farmland
            ->cropBuyers()
            ->sync($farmlandData['cropBuyers']);

        $farmerIds = $farmlandData['farmers'];

        $this->validateIfFarmersBelongToBatch($farmland, $farmerIds);

        $farmland
            ->farmers()
            ->sync($farmerIds);

        return $farmland->refresh();
    }

    private function validateIfFarmersBelongToBatch(Farmland $farmland, array $farmerIds): void
    {
        $batchFarmers = Farmer::ofBatch($farmland->batch)->get();

        foreach ($farmerIds as $farmerId) {
            if (! $batchFarmers->contains('id', $farmerId)) {
                throw new Exception('Farmer does not belong to batch');
            }
        }
    }

    private function validateIfBigBrotherBelongsToBatch(Farmland $farmland, User $user): void
    {
        if (! $farmland->batch->bigBrothers->contains('id', $user->id)) {
            throw new Exception('Big Brother does not belong to batch');
        }
    }

    public function asOrchidAction(mixed $model, ?Request $request): RedirectResponse
    {
        /**
         * @var User
         */
        $user = $request->user();

        $farmlandData = $request->get('farmland');

        try {
            $this->handle($model, $farmlandData, $user);
        } catch (Exception $exception) {
            Toast::error($exception->getMessage());

            if ($model->exists) {
                return redirect()->route('platform.farmlands.edit', [
                    $model->id,
                ]);
            } else {
                return redirect()->route('platform.farmlands.create');
            }
        }

        Toast::info(__('Farmland was saved successfully!'));

        return redirect()->route('platform.farmlands');
    }

    public function rules(): array
    {
        return [
            'farmland.name' => [
                'required',
                'alpha_num_space_dash',
                'min:3',
                'max:70',
            ],
            'farmland.batch_id' => [
                'required',
                'integer',
                'exists:batches,id',
            ],
            'farmland.type_id' => [
                'required',
                'integer',
                'exists:farmland_types,id',
            ],
            'farmland.status_id' => [
                'required',
                'integer',
                'exists:farmland_statuses,id',
            ],
            'farmland.hectares_size' => [
                'required',
                'numeric',
                'min:1',
                'max:1000000',
            ],
            'farmland.wateringSystems' => [
                'required',
                'array',
            ],
            'farmland.wateringSystems.*' => [
                'integer',
                'exists:watering_systems,id',
            ],
            'farmland.cropBuyers' => [
                'required',
                'array',
            ],
            'farmland.cropBuyers.*' => [
                'integer',
                'exists:crop_buyers,id',
            ],
            'farmland.farmers' => [
                'required',
                'array',
            ],
            'farmland.farmers.*' => [
                'integer',
                'exists:users,id',
            ],
        ];
    }

    public function authorize(Request $request, mixed $model): bool
    {
        /**
         * @var User
         */
        $user = $request->user();

        return $user->canAny(['create', 'update'], $model);
    }
}
