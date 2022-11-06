<?php

namespace App\Policies;

use App\Models\FarmerReport\FarmerReport;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FarmerReportPolicy
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

    public function view(User $user, FarmerReport $farmerReport): bool
    {
        return $this->belongsToFarmerReport($user, $farmerReport);
    }

    public function create(User $user): bool
    {
        return $user->isAdministrator();
    }

    public function update(User $user, FarmerReport $farmerReport): bool
    {
        return $this->belongsToFarmerReport($user, $farmerReport);
    }

    public function delete(User $user, FarmerReport $farmerReport): bool
    {
        return $user->isAdministrator();
    }

    private function belongsToFarmerReport(User $user, FarmerReport $farmerReport): bool
    {
        $batch = $farmerReport->farmland->batch;

        if (is_null($batch)) {
            return false;
        } else {
            return $batch->bigBrothers->contains($user->id);
        }
    }
}
