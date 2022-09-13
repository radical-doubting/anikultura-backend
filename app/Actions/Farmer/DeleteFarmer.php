<?php

namespace App\Actions\Farmer;

use App\Models\Farmer\Farmer;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class DeleteFarmer
{
    use AsAction;
    use AsOrchidAction;

    public function handle(Farmer $farmer): bool
    {
        return $farmer->delete();
    }

    public function asOrchidAction(mixed $model, ?Request $request): RedirectResponse
    {
        $this->handle($model);

        Toast::info(__('Farmer was removed successfully!'));

        return redirect()->route('platform.farmers');
    }
}
