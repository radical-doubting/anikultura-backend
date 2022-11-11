<?php

namespace App\Actions\Site\Region;

use App\Models\Site\Region;
use App\Models\User\User;
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

    public function asOrchidAction(mixed $model, Request $request): RedirectResponse
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
                'alpha_num_space_dash',
                'min:3',
                'max:70',
            ],
            'region.short_name' => [
                'required',
                'alpha_num_space_dash',
                'min:3',
                'max:10',
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
