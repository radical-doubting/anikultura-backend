<?php

namespace App\Actions\Farmland;

use App\Models\Farmland\Farmland;
use App\Models\User\Farmer\Farmer;
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

    public function handle(Farmland $farmland, array $farmlandData): Farmland
    {
        $farmland
            ->fill($farmlandData)
            ->save();

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

    public function asOrchidAction(mixed $model, ?Request $request): RedirectResponse
    {
        $farmlandData = $request->get('farmland');

        $this->handle($model, $farmlandData);

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
}
