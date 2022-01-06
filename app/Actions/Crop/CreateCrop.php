<?php

namespace App\Actions\Batch;

use App\Models\Crop;
use App\Traits\AsOrchidAction;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class CreateCrop
{
    use AsAction;

    use AsOrchidAction;

    public function handle(Crop $crop, $cropData)
    {
        $crop
            ->fill($cropData)
            ->save();
    }

    public function asOrchidAction($model, ?Request $request)
    {
        $cropData = $request->get('crop');

        $this->handle($model, $cropData);

        Toast::info(__('Crop was saved successfully!'));

        return redirect()->route('platform.crops');
    }

    public function rules(): array
    {
        return [
            'crop.group' => [
                'required',
            ],
            'crop.name' => [
                'required',
            ],
            'crop.variety' => [
                'required',
            ],
            'crop.establishment_days' => [
                'required',
            ],
            'crop.vegetative_days' => [
                'required',
            ],
            'crop.yield_formation_days' => [
                'required',
            ],
            'crop.ripening_days' => [
                'required',
            ],
        ];
    }
}
