<?php

namespace App\Actions\Farmer;

use App\Models\Farmer\FarmerPreference;
use App\Models\Farmer\FarmerProfile;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateFarmerPreference
{
    use AsAction;

    public function handle(FarmerProfile $farmerProfile): ?FarmerPreference
    {
        if (! $farmerProfile->exists) {
            throw new ModelNotFoundException(
                'Cannot add farmer preference on non-existent farmer profile'
            );
        }

        $farmerPreference = $farmerProfile
            ->preference()
            ->firstOrCreate();

        return $farmerPreference->refresh();
    }
}
