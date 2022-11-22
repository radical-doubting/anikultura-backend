<?php

namespace App\Policies\Site;

use App\Models\Site\Region;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RegionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->isAdministrator();
    }

    public function view(User $user, Region $region): bool
    {
        return $user->isAdministrator();
    }

    public function create(User $user): bool
    {
        return $user->isAdministrator();
    }

    public function update(User $user, Region $region): bool
    {
        return $user->isAdministrator();
    }

    public function delete(User $user, Region $region): bool
    {
        return $user->isAdministrator();
    }
}
