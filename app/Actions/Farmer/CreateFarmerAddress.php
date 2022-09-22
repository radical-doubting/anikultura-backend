<?php

namespace App\Actions\Farmer;

use App\Models\Farmer\FarmerAddress;
use App\Models\Farmer\FarmerProfile;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateFarmerAddress
{
    use AsAction;

    public function handle(
        FarmerProfile $farmerProfile,
        FarmerAddress $farmerAddress,
        array $farmerAddressData
    ): FarmerAddress {
        $farmerAddress
            ->farmerProfile()
            ->associate($farmerProfile);

        $farmerAddress
            ->fill($farmerAddressData)
            ->save();

        return $farmerAddress->refresh();
    }
}
