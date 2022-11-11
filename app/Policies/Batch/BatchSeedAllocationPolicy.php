<?php

namespace App\Policies\Batch;

use App\Models\Batch\BatchSeedAllocation;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BatchSeedAllocationPolicy
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

    public function view(User $user, BatchSeedAllocation $batchSeedAllocation): bool
    {
        return $this->belongsToBatch($user, $batchSeedAllocation);
    }

    public function create(User $user): bool
    {
        return $user->isAdministrator();
    }

    public function update(User $user, BatchSeedAllocation $batchSeedAllocation): bool
    {
        return $this->belongsToBatch($user, $batchSeedAllocation);
    }

    public function delete(User $user, BatchSeedAllocation $batchSeedAllocation): bool
    {
        return $user->isAdministrator();
    }

    private function belongsToBatch(User $user, BatchSeedAllocation $batchSeedAllocation): bool
    {
        $batch = $batchSeedAllocation->batch;

        if (is_null($batch)) {
            return false;
        } else {
            return $batch->bigBrothers->contains($user->id);
        }
    }
}
