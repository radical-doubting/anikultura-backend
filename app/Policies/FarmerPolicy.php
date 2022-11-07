<?php

namespace App\Policies;

use App\Models\User\Farmer\Farmer;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FarmerPolicy
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

    public function view(User $user, Farmer $farmer): bool
    {
        if ($farmer->exists) {
            return $this->belongsToFarmer($user, $farmer);
        } else {
            return $user->isAdministrator() || $user->isBigBrother();
        }
    }

    public function create(User $user): bool
    {
        return $user->isAdministrator() || $user->isBigBrother();
    }

    public function update(User $user, Farmer $farmer): bool
    {
        return $this->belongsToFarmer($user, $farmer);
    }

    public function delete(User $user, Farmer $farmer): bool
    {
        return $this->belongsToFarmer($user, $farmer);
    }

    private function belongsToFarmer(User $user, Farmer $farmer): bool
    {
        $farmers = Farmer::ofBigBrother($user)->get();

        return $farmers->contains($farmer->id);
    }
}
