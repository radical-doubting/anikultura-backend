<?php

namespace App\Actions\Site\Region;

use App\Models\Site\Region;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class CreateRegion
{
    use AsAction;
    use AsOrchidAction;

    public function handle(Region $region, array $regionData): Region
    {
        $region->fill($regionData)->save();

        return $region->refresh();
    }

    public function asOrchidAction(mixed $model, ?Request $request): RedirectResponse
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
