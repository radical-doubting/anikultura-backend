<?php

namespace App\Actions\User\BigBrother;

use App\Models\User\BigBrother\BigBrotherProfile;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateBigBrotherProfile
{
    use AsAction;

    public function handle(?BigBrotherProfile $bigBrotherProfile, $bigBrotherProfileData)
    {
        if (is_null($bigBrotherProfile)) {
            $newBigBrotherProfile = new BigBrotherProfile($bigBrotherProfileData);
            $newBigBrotherProfile->save();

            return $newBigBrotherProfile->id;
        } else {
            $bigBrotherProfile
                ->fill($bigBrotherProfileData)
                ->save();

            return $bigBrotherProfile->id;
        }
    }
}
