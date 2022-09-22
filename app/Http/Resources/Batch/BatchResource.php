<?php

namespace App\Http\Resources\Batch;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Batch\Batch
 */
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
