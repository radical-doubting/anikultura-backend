<?php

namespace App\Http\Resources\Farmer;

use App\Models\Farmer\FarmerPreference;
use App\Models\Farmer\Gender;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Farmer\FarmerProfile
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
            'language' => $preference->language,
            'gender' => $gender->name,
            'birthday' => $this->birthday,
            'affiliatedOrganization' => $this->affiliated_organization,
            'tesdaTrainingJoined' => $this->tesda_training_joined,
            'joinedAt' => $this->created_at,
        ];
    }
}
