<?php

namespace App\Policies\User;

use App\Models\User\BigBrother\BigBrother;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BigBrotherPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->isAdministrator();
    }

    public function view(User $user, BigBrother $bigBrother): bool
    {
        return $user->isAdministrator();
    }

    public function create(User $user): bool
    {
        return $user->isAdministrator();
    }

    public function update(User $user, BigBrother $bigBrother): bool
    {
        return $user->isAdministrator();
    }

    public function delete(User $user, BigBrother $bigBrother): bool
    {
        return $user->isAdministrator();
    }
}
