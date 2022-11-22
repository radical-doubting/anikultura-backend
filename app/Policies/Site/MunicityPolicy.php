<?php

namespace App\Policies\Site;

use App\Models\Site\Municity;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MunicityPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->isAdministrator();
    }

    public function view(User $user, Municity $municity): bool
    {
        return $user->isAdministrator();
    }

    public function create(User $user): bool
    {
        return $user->isAdministrator();
    }

    public function update(User $user, Municity $municity): bool
    {
        return $user->isAdministrator();
    }

    public function delete(User $user, Municity $municity): bool
    {
        return $user->isAdministrator();
    }
}
