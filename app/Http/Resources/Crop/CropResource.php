<?php

namespace App\Http\Resources\Crop;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Crop\Crop
 */
class CropResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
