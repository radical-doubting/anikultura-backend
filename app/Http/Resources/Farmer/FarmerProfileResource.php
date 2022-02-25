<?php

namespace App\Http\Resources\Farmer;

use Illuminate\Http\Resources\Json\JsonResource;

class FarmerProfileResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'gender' => $this->gender,
            'birthday' => $this->birthday,
            'age' => $this->age,
            'affiliatedOrganization' => $this->affiliated_organization,
            'tesdaTrainingJoined' => $this->tesda_training_joined,
        ];
    }
}
