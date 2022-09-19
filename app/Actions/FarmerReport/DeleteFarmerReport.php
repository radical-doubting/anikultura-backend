<?php

namespace App\Actions\FarmerReport;

use App\Models\FarmerReport\FarmerReport;
use App\Traits\AsOrchidAction;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class DeleteFarmerReport
{
    use AsAction;
    use AsOrchidAction;

    public function handle(FarmerReport $farmerReport)
    {
        $farmerReport->delete();
    }

    public function asOrchidAction($model, ?Request $request)
    {
        $this->handle($model);

        Toast::info(__('Farmer report was removed successfully!'));

        return redirect()->route('platform.farmer-reports');
    }
}
