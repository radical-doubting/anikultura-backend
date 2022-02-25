<?php

namespace App\Http\Resources\Batch;

use App\Http\Resources\Crop\CropResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BatchSeedAllocationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'seedAmount' => $this->seed_amount,
            'batch' => new BatchResource($this->batch),
            'crop' => new CropResource($this->crop),
        ];
    }
}
