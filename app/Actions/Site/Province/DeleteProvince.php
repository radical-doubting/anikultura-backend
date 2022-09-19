<?php

namespace App\Actions\Site\Province;

use App\Models\Site\Province;
use App\Traits\AsOrchidAction;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class DeleteProvince
{
    use AsAction;
    use AsOrchidAction;

    public function handle(Province $province): bool
    {
        return $province->delete();
    }

    public function asOrchidAction($model, ?Request $request)
    {
        $this->handle($model);

        Toast::info(__('Province was removed successfully!'));

        return redirect()->route('platform.sites.provinces');
    }
}
