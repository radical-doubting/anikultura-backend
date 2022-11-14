<?php

namespace App\Actions\User\BigBrother;

use App\Models\User\BigBrother\BigBrotherProfile;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateBigBrotherProfile
{
    use AsAction;

    public function handle(
        BigBrotherProfile $bigBrotherProfile,
        array $bigBrotherProfileData
    ): BigBrotherProfile {
        $bigBrotherProfile
            ->fill($bigBrotherProfileData)
            ->save();

        return $bigBrotherProfile->refresh();
    }
}
