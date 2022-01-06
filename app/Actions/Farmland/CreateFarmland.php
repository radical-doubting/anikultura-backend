<?php

namespace App\Actions\Farmland;

use App\Models\Farmland\Farmland;
use App\Traits\AsOrchidAction;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class CreateFarmland
{
    use AsAction;

    use AsOrchidAction;

    public function handle(Farmland $farmland, $farmlandData)
    {
        $farmland
            ->fill($farmlandData)
            ->save();

        $farmland
            ->watering_systems()
            ->sync($farmlandData['watering_systems']);

        $farmland
            ->crop_buyers()
            ->sync($farmlandData['crop_buyers']);

        $farmland
            ->farmers()
            ->sync($farmlandData['farmers']);
    }

    public function asOrchidAction($model, ?Request $request)
    {
        $farmlandData = $request->get('farmland');

        $this->handle($model, $farmlandData);

        Toast::info(__('Farmland was successfully saved!'));

        return redirect()->route('platform.farmer.farmland.view.all');
    }

    public function rules(): array
    {
        return [
            'farmland.type_id' => [
                'required',
            ],
            'farmland.status_id' => [
                'required',
            ],
            'farmland.hectares_size' => [
                'required',
            ],
            'farmland.watering_systems' => [
                'required',
                'array',
            ],
            'farmland.crop_buyers' => [
                'required',
                'array',
            ],
            'farmland.farmers' => [
                'required',
                'array',
            ],
        ];
    }
}
