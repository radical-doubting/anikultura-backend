<?php

namespace App\Actions\Farmer;

use App\Models\Farmer\FarmerProfile;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateFarmerProfile
{
    use AsAction;

    public function handle(?FarmerProfile $farmerProfile, $farmerProfileData)
    {
        if (is_null($farmerProfile)) {
            $newFarmerProfile = new FarmerProfile($farmerProfileData);
            $newFarmerProfile->save();

            return $newFarmerProfile->id;
        } else {
            $farmerProfile
                ->fill($farmerProfileData)
                ->save();

            return $farmerProfile->id;
        }
    }
}
