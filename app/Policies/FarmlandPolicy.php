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
        return $this->belongsToFarmland($user, $farmland);
    }

    public function create(User $user): bool
    {
        return $user->isAdministrator();
    }

    public function update(User $user, Farmland $farmland): bool
    {
        return $this->belongsToFarmland($user, $farmland);
    }

    public function delete(User $user, Farmland $farmland): bool
    {
        return $user->isAdministrator();
    }

    private function belongsToFarmland(User $user, Farmland $farmland): bool
    {
        $batch = $farmland->batch;

        if (is_null($batch)) {
            return false;
        } else {
            return $batch->bigBrothers->contains($user->id);
        }
    }
}
