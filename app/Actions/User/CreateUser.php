<?php

namespace App\Actions\User;

use App\Actions\Authentication\HashPassword;
use App\Models\User\User;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateUser
{
    use AsAction;

    public function __construct(
        protected HashPassword $hashPassword
    ) {
    }

    public function handle(User $user, array $userData): User
    {
        $cleanedUserData = $this->handlePassword($userData);

        $user->fill($cleanedUserData)->save();

        return $user->refresh();
    }

    private function handlePassword(array $userData): array
    {
        $plaintextPassword = $userData['password'];

        if (empty($plaintextPassword)) {
            unset($userData['password']);
        } else {
            $hashedPassword = $this->hashPassword->handle($plaintextPassword);
            $userData['password'] = $hashedPassword;
        }

        return $userData;
    }
}
