<?php

namespace App\Policies\User;

use App\Models\User\Admin\Admin;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->isAdministrator();
    }

    public function view(User $user, Admin $admin): bool
    {
        return $user->isAdministrator();
    }

    public function create(User $user): bool
    {
        return $user->isAdministrator();
    }

    public function update(User $user, Admin $admin): bool
    {
        return $user->isAdministrator();
    }

    public function delete(User $user, Admin $admin): bool
    {
        return $user->isAdministrator();
    }
}
