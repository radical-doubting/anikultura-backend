<?php

namespace App\Actions\User\Admin;

use App\Models\User\Admin\AdminProfile;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateAdminProfile
{
    use AsAction;

    public function handle(
        AdminProfile $adminProfile,
        array $adminProfileData
    ): AdminProfile {
        $adminProfile
            ->fill($adminProfileData)
            ->save();

        return $adminProfile->refresh();
    }
}
