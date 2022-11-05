<?php

namespace App\Policies;

use App\Models\Farmland\Farmland;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FarmlandPolicy
{
    use HandlesAuthorization;

    public function before(User $user, string $ability): ?bool
    {
        if ($user->isAdministrator()) {
            return true;
        } else {
            return null;
        }
    }

    public function viewAny(User $user): bool
    {
        return $user->isAdministrator();
    }

    public function view(User $user, Farmland $farmland): bool
    {
        return $farmland->batch->bigBrothers->contains($user->id);
    }

    public function create(User $user): bool
    {
        return $user->isAdministrator();
    }

    public function update(User $user, Farmland $farmland): bool
    {
        return $farmland->batch->bigBrothers->contains($user->id);
    }

    public function delete(User $user, Farmland $farmland): bool
    {
        return $user->isAdministrator();
    }
}
