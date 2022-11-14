<?php

namespace App\Policies;

use App\Models\Crop\Crop;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CropPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->isAdministrator();
    }

    public function view(User $user, Crop $crop): bool
    {
        return $user->isAdministrator();
    }

    public function create(User $user): bool
    {
        return $user->isAdministrator();
    }

    public function update(User $user, Crop $crop): bool
    {
        return $user->isAdministrator();
    }

    public function delete(User $user, Crop $crop): bool
    {
        return $user->isAdministrator();
    }
}
