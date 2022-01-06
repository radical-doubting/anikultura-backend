<?php

namespace App\Actions\Site\Province;

use App\Models\Site\Province;
use App\Traits\AsOrchidAction;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class CreateProvince
{
    use AsAction;

    use AsOrchidAction;

    public function handle(Province $province, $provinceData)
    {
        $province
            ->fill($provinceData)
            ->save();
    }

    public function asOrchidAction($model, ?Request $request)
    {
        $provinceData = $request->get('province');

        $this->handle($model, $provinceData);

        Toast::info(__('Province was successfully saved!'));

        return redirect()->route('platform.sites.provinces');
    }

    public function rules(): array
    {
        return [
            'province.name' => [
                'required',
            ],
            'province.region_id' => [
                'required',
            ],
        ];
    }
}
