<?php

namespace App\Actions\Farmer;

use App\Models\Farmer\FarmerProfile;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteFarmerProfile
{
    use AsAction;

    public function handle(FarmerProfile $farmerProfile)
    {
        $farmerProfile->delete();
    }
}
