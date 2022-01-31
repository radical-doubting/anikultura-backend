<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateUser
{
    use AsAction;

    public function handle(User $user, $userData)
    {
        if (is_null($user)) {
            $this->createNewUser($user, $userData);

            return;
        }

        $this->updateExistingUser($user, $userData);
    }

    private function createNewUser($existingUser, $userData)
    {
        $newUser = new User($userData);
        $plainTextPassword = $userData['password'];
        $newUser->password = $this->hashPassword($plainTextPassword);
        $newUser->save();

        $existingUser->save($newUser);
    }

    private function updateExistingUser($user, $userData)
    {
        $updatedUserDataData = $this->updatePassword($userData);
        $user->update($updatedUserDataData);
    }

    private function updatePassword($userData)
    {
        $password = $userData['password'];

        if (empty($password)) {
            unset($userData['password']);

            return $userData;
        }

        $userData['password'] = $this->hashPassword($password);

        return $userData;
    }

    private function hashPassword(string $plainTextPassword)
    {
        return Hash::make($plainTextPassword);
    }
}
