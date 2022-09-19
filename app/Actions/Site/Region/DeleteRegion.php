<?php

namespace App\Actions\Site\Region;

use App\Models\Site\Region;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class DeleteRegion
{
    use AsAction;
    use AsOrchidAction;

    public function handle(Region $region): bool
    {
        return $region->delete();
    }

    public function asOrchidAction(mixed $model, ?Request $request): RedirectResponse
    {
        $this->handle($model);

        Toast::info(__('Region was removed successfully!'));

        return redirect()->route('platform.sites.regions');
    }
}
