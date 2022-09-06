<?php

namespace App\Http\Resources\Farmer;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Farmer\FarmerProfile
 */
class FarmerProfileResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'isTutorialDone' => $this->tutorial_done,
            'gender' => $this->gender,
            'birthday' => $this->birthday,
            'age' => $this->age,
            'affiliatedOrganization' => $this->affiliated_organization,
            'tesdaTrainingJoined' => $this->tesda_training_joined,
            'joinedAt' => $this->created_at,
        ];
    }
}
