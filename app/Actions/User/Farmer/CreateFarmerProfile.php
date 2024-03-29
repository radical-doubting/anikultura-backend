<?php

namespace App\Actions\User\Farmer;

use App\Models\User\Farmer\FarmerProfile;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateFarmerProfile
{
    use AsAction;

    public function __construct(
        protected CreateFarmerPreference $createFarmerPreference
    ) {
    }

    public function handle(FarmerProfile $farmerProfile, array $farmerProfileData): FarmerProfile
    {
        $farmerProfile
            ->fill($farmerProfileData)
            ->save();

        $this->createFarmerPreference->handle($farmerProfile);

        return $farmerProfile->refresh();
    }
}
