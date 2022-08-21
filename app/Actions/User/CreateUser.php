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
        if (! $user->exists) {
            return $this->createNewUser($userData);
        } else {
            return $this->updateExistingUser($user, $userData);
        }
    }

    private function createNewUser($userData)
    {
        $newUser = new User($userData);
        $newUser->password = $this->hashPassword($userData['password']);
        $newUser->save();

        return $newUser->id;
    }

    private function updateExistingUser($user, $userData)
    {
        $updatedUserDataData = $this->updatePassword($userData);
        $user->update($updatedUserDataData);

        return $user->id;
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
