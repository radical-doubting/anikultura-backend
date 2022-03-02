<?php

namespace App\Http\Resources\Batch;

use Illuminate\Http\Resources\Json\JsonResource;

class BatchResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'farmSchoolName' => $this->farmschool_name,
        ];
    }
}
