<?php

namespace App\Actions\BigBrother;

use App\Models\User\BigBrother\BigBrotherProfile;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteBigBrotherProfile
{
    use AsAction;

    public function handle(BigBrotherProfile $bigBrotherProfile): bool
    {
        return $bigBrotherProfile->delete();
    }
}
