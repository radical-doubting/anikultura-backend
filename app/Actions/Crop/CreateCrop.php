<?php

namespace App\Actions\Crop;

use App\Models\Crop\Crop;
use App\Models\User\User;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class CreateCrop
{
    use AsAction;
    use AsOrchidAction;

    public function handle(Crop $crop, array $cropData): Crop
    {
        $crop
            ->fill($cropData)
            ->save();

        return $crop->refresh();
    }

    public function asOrchidAction(mixed $model, Request $request): RedirectResponse
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
                'alpha_num_space_dash',
                'min:3',
                'max:70',
            ],
            'crop.name' => [
                'required',
                'alpha_num_space_dash',
                'min:3',
                'max:70',
            ],
            'crop.variety' => [
                'required',
                'alpha_num_space_dash',
                'min:3',
                'max:70',
            ],
            'crop.gross_returns_per_ha' => [
                'required',
                'numeric',
                'min:1',
                'max:1000000',
            ],
            'crop.total_costs_per_ha' => [
                'required',
                'numeric',
                'min:1',
                'max:1000000',
            ],
            'crop.production_cost_per_kg' => [
                'required',
                'numeric',
                'min:1',
                'max:1000000',
            ],
            'crop.farmgate_price_per_kg' => [
                'required',
                'numeric',
                'min:1',
                'max:1000000',
            ],
            'crop.yield_per_ha' => [
                'required',
                'numeric',
                'min:1',
                'max:1000000',
            ],
            'crop.maturity_lower_bound' => [
                'required',
                'numeric',
                'min:1',
                'max:7200',
                'lt:crop.maturity_upper_bound',
            ],
            'crop.maturity_upper_bound' => [
                'required',
                'numeric',
                'min:1',
                'max:7200',
                'gt:crop.maturity_lower_bound',
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
