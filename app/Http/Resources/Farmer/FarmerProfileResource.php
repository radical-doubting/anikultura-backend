<?php

namespace App\Http\Resources\Farmer;

use App\Models\User\Farmer\FarmerPreference;
use App\Models\User\Farmer\Gender;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\User\Farmer\FarmerProfile
 */
class FarmerProfileResource extends JsonResource
{
    public function toArray($request)
    {
        /**
         * @var Gender
         */
        $gender = $this->gender;

        /**
         * @var FarmerPreference
         */
        $preference = $this->preference;

        return [
            'isTutorialDone' => $preference->tutorial_done,
            'gender' => $gender->name,
            'birthday' => $this->birthday,
            'affiliatedOrganization' => $this->affiliated_organization,
            'tesdaTrainingJoined' => $this->tesda_training_joined,
            'joinedAt' => $this->created_at,
        ];
    }
}
