<?php

namespace App\Actions\User\Farmer;

use App\Models\User\Farmer\FarmerAddress;
use App\Models\User\Farmer\FarmerProfile;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateFarmerAddress
{
    use AsAction;

    public function handle(
        FarmerProfile $farmerProfile,
        FarmerAddress $farmerAddress,
        array $farmerAddressData
    ): ?FarmerAddress {
        if (! $farmerProfile->exists) {
            throw new ModelNotFoundException(
                'Cannot add farmer address on non-existent farmer profile'
            );
        }

        $farmerAddress
            ->farmerProfile()
            ->associate($farmerProfile);

        $farmerAddress
            ->fill($farmerAddressData)
            ->save();

        return $farmerAddress->refresh();
    }
}
