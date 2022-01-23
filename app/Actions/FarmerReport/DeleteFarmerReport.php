<?php

namespace App\Actions\FarmerReport;

use App\Models\FarmerReport\FarmerReport;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class DeleteFarmerReport
{
    use AsAction;

    public function handle(FarmerReport $farmerReport)
    {
        $farmerReport->delete();
    }

    public function asController($model, ?Request $request)
    {
        $this->handle($model);

        Toast::info(__('Farmer report was removed successfully!'));

        return redirect()->route('platform.farmer-reports');
    }
}
