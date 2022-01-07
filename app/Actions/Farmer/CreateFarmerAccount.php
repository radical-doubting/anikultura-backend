<?php

namespace App\Actions\Farmer;

use App\Models\Farmer\FarmerProfile;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateFarmerAccount
{
    use AsAction;

    public function handle(FarmerProfile $farmerProfile, $farmerAccountData)
    {
        $existingFarmerAccount = $farmerProfile->user();

        if (!$existingFarmerAccount->exists()) {
            $this->createNewFarmerAccount($existingFarmerAccount, $farmerAccountData);
            return;
        }

        $this->updateExistingFarmerAccount($existingFarmerAccount, $farmerAccountData);
    }

    private function createNewFarmerAccount($existingFarmerAccount, $farmerAccountData)
    {
        $newFarmerAccount = new User($farmerAccountData);
        $plainTextPassword = $farmerAccountData['password'];
        $newFarmerAccount->password = $this->hashPassword($plainTextPassword);
        $newFarmerAccount->save();

        $existingFarmerAccount->save($newFarmerAccount);
    }

    private function updateExistingFarmerAccount($farmerAccount, $farmerAccountData)
    {
        $updatedAccountData = $this->updatePassword($farmerAccountData);
        $farmerAccount->update($updatedAccountData);
    }

    private function updatePassword($farmerAccountData)
    {
        $password = $farmerAccountData['password'];

        if (empty($password)) {
            unset($farmerAccountData['password']);
            return $farmerAccountData;
        }

        $farmerAccountData['password'] = $this->hashPassword($password);

        return $farmerAccountData;
    }

    private function hashPassword(string $plainTextPassword)
    {
        return Hash::make($plainTextPassword);
    }
}
