<?php

namespace App\Actions\Crop;

use App\Models\Crop\Crop;
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
            'crop.gross_returns_per_ha' => [
                'required',
                'numeric',
            ],
            'crop.total_costs_per_ha' => [
                'required',
                'numeric',
            ],
            'crop.production_cost_per_kg' => [
                'required',
                'numeric',
            ],
            'crop.farmgate_price_per_kg' => [
                'required',
                'numeric',
            ],
            'crop.yield_per_ha' => [
                'required',
                'numeric',
            ],
            'crop.maturity_lower_bound' => [
                'required',
                'numeric',
                'lt:crop.maturity_upper_bound',
            ],
            'crop.maturity_upper_bound' => [
                'required',
                'numeric',
                'gt:crop.maturity_lower_bound',
            ],
        ];
    }
}
