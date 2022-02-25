<?php

namespace App\Http\Resources\Crop;

use Illuminate\Http\Resources\Json\JsonResource;

class SeedStageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
