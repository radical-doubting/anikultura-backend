<?php

namespace App\Actions\Farmland;

use App\Models\Farmland\Farmland;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class DeleteFarmland
{
    use AsAction;
    use AsOrchidAction;

    public function handle(Farmland $farmland): bool
    {
        return $farmland->delete();
    }

    public function asOrchidAction(mixed $model, ?Request $request): RedirectResponse
    {
        $this->handle($model);

        Toast::info(__('Farmland was removed successfully!'));

        return redirect()->route('platform.farmlands');
    }
}
