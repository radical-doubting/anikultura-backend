<?php

namespace App\Actions\Farmer;

use App\Models\Farmer\FarmerProfile;
use App\Traits\AsOrchidAction;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class DeleteFarmerProfile
{
    use AsAction;

    use AsOrchidAction;

    public function handle(FarmerProfile $farmerProfile)
    {
        $farmerProfile->delete();
    }

    public function asOrchidAction($model, ?Request $request)
    {
        $this->handle($model);

        Toast::info(__('Farmer profile was removed successfully!'));

        return redirect()->route('platform.farmers');
    }
}
