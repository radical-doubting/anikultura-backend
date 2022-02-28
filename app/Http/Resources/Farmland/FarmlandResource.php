<?php

namespace App\Http\Resources\Farmland;

use Illuminate\Http\Resources\Json\JsonResource;

class FarmlandResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'hectaresSize' => $this->hectares_size,
        ];
    }
}
