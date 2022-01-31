<?php

namespace App\Actions\BigBrother;

use App\Models\BigBrother\BigBrotherProfile;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateBigBrotherProfile
{
    use AsAction;

    public function handle(BigBrotherProfile $bigBrotherProfile, $bigBrotherData)
    {
        $bigBrotherProfile
            ->fill($bigBrotherData)
            ->save();
    }
}
