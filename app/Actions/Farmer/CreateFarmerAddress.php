<?php

namespace App\Actions\Farmer;

use App\Models\Farmer\FarmerAddress;
use App\Models\Farmer\FarmerProfile;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateFarmerAddress
{
    use AsAction;

    public function handle(FarmerProfile $farmerProfile, $farmerAddressData)
    {
        $farmerProfileId = $farmerProfile->id;
        $existingFarmerAddress = $farmerProfile->farmerAddress();

        if (! $existingFarmerAddress->exists()) {
            $this->createNewFarmerAddress($existingFarmerAddress, $farmerAddressData, $farmerProfileId);

            return;
        }

        $this->updateExistingFarmerAddress($existingFarmerAddress, $farmerAddressData);
    }

    private function createNewFarmerAddress($existingFarmerAddress, $farmerAddressData, $farmerProfileId)
    {
        $newFarmerAddress = new FarmerAddress($farmerAddressData);
        $newFarmerAddress['farmer_profile_id'] = $farmerProfileId;
        $existingFarmerAddress->save($newFarmerAddress);
    }

    private function updateExistingFarmerAddress($existingFarmerAddress, $farmerAddressData)
    {
        $existingFarmerAddress->update($farmerAddressData);
    }
}
