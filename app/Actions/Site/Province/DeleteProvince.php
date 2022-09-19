<?php

namespace App\Actions\Site\Province;

use App\Models\Site\Province;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class DeleteProvince
{
    use AsAction;
    use AsOrchidAction;

    public function handle(Province $province): bool
    {
        $isDeleted = $province->delete();

        if (is_null($isDeleted)) {
            return false;
        }

        return $isDeleted;
    }

    public function asOrchidAction(mixed $model, ?Request $request): RedirectResponse
    {
        $this->handle($model);

        Toast::info(__('Province was removed successfully!'));

        return redirect()->route('platform.sites.provinces');
    }
}
