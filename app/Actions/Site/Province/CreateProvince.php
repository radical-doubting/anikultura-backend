<?php

namespace App\Actions\Site\Province;

use App\Models\Site\Province;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class CreateProvince
{
    use AsAction;
    use AsOrchidAction;

    public function handle(Province $province, array $provinceData): Province
    {
        $province->fill($provinceData)->save();

        return $province->refresh();
    }

    public function asOrchidAction(mixed $model, ?Request $request): RedirectResponse
    {
        $provinceData = $request->get('province');

        $this->handle($model, $provinceData);

        Toast::info(__('Province was saved successfully!'));

        return redirect()->route('platform.sites.provinces');
    }

    public function rules(): array
    {
        return [
            'province.name' => [
                'required',
                'alpha_num_space_dash',
                'min:3',
                'max:70',
            ],
            'province.region_id' => [
                'required',
                'integer',
                'exists:regions,id',
            ],
        ];
    }
}
