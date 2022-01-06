<?php

namespace App\Actions\Farmland;

use App\Models\Farmland\Farmland;
use App\Traits\AsOrchidAction;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class DeleteFarmland
{
    use AsAction;

    use AsOrchidAction;

    public function handle(Farmland $farmland)
    {
        $farmland->delete();
    }

    public function asOrchidAction($model, ?Request $request)
    {
        $this->handle($model);

        Toast::info(__('Farmland was removed successfully!'));

        return redirect()->route('platform.farmer.farmland.view.all');
    }
}
