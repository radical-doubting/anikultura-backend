<?php

namespace App\Policies\Site;

use App\Models\Site\Province;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProvincePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->isAdministrator();
    }

    public function view(User $user, Province $province): bool
    {
        return $user->isAdministrator();
    }

    public function create(User $user): bool
    {
        return $user->isAdministrator();
    }

    public function update(User $user, Province $province): bool
    {
        return $user->isAdministrator();
    }

    public function delete(User $user, Province $province): bool
    {
        return $user->isAdministrator();
    }
}
