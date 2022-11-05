<?php

namespace App\Policies;

use App\Models\Batch\Batch;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BatchPolicy
{
    use HandlesAuthorization;

    public function before(User $user, string $ability): ?bool
    {
        if ($user->isAdministrator()) {
            return true;
        }
    }

    public function viewAny(User $user): bool
    {
        return $user->isAdministrator();
    }

    public function view(User $user, Batch $batch): bool
    {
        return $batch->bigBrothers->contains($user->id);
    }

    public function create(User $user): bool
    {
        return $user->isAdministrator();
    }

    public function update(User $user, Batch $batch): bool
    {
        return $batch->bigBrothers->contains($user->id);
    }

    public function delete(User $user, Batch $batch): bool
    {
        return $user->isAdministrator();
    }
}
