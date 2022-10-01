<?php

namespace App\Actions\User\Farmer;

use App\Models\User\Farmer\FarmerProfile;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteFarmerProfile
{
    use AsAction;

    public function handle(FarmerProfile $farmerProfile): bool
    {
        return $farmerProfile->delete();
    }
}
