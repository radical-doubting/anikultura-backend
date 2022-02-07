<?php

namespace App\Actions\Farmer;

use App\Models\Farmer\FarmerProfile;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateFarmerProfile
{
    use AsAction;

    public function handle(FarmerProfile $farmerProfile, $farmerProfileData)
    {
        $farmerProfile
            ->fill($farmerProfileData)
            ->save();
    }
}
