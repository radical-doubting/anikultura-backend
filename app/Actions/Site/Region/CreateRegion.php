<?php

namespace App\Actions\Site\Region;

use App\Models\Site\Region;
use App\Traits\AsOrchidAction;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class CreateRegion
{
    use AsAction;
    use AsOrchidAction;

    public function handle(Region $region, $regionData)
    {
        $region
            ->fill($regionData)
            ->save();
    }

    public function asOrchidAction($model, ?Request $request)
    {
        $regionData = $request->get('region');

        $this->handle($model, $regionData);

        Toast::info(__('Region was saved successfully!'));

        return redirect()->route('platform.sites.regions');
    }

    public function rules(): array
    {
        return [
            'region.name' => [
                'required',
            ],
            'region.short_name' => [
                'required',
            ],
        ];
    }
}
