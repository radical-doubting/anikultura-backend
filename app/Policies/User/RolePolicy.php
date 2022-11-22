<?php

namespace App\Policies\User;

use App\Models\User\Role;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->isAdministrator();
    }

    public function view(User $user, Role $role): bool
    {
        return $user->isAdministrator();
    }

    public function create(User $user): bool
    {
        return $user->isAdministrator();
    }

    public function update(User $user, Role $role): bool
    {
        return $user->isAdministrator();
    }

    public function delete(User $user, Role $role): bool
    {
        return $user->isAdministrator();
    }
}
