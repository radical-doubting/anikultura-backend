<?php

namespace App\Http\Resources\Farmer;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\User\Farmer\FarmerPreference
 */
class TutorialStateResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'isTutorialDone' => $this->tutorial_done,
        ];
    }
}
