<?php

namespace App\Http\Resources\FarmerReport;

use App\Http\Resources\BigBrother\BigBrotherResource;
use App\Http\Resources\Crop\CropResource;
use App\Http\Resources\Crop\SeedStageResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\FarmerReport\FarmerReport
 */
class FarmerReportResource extends JsonResource
{
    public function toArray($request)
    {
        $isValid = $this->isValid();

        return [
            'id' => $this->id,
            'isVerified' => $isValid,
            $this->mergeWhen($isValid, [
                'verifier' => new BigBrotherResource($this->verifier),
            ]),
            $this->mergeWhen($this->isHarvested(), [
                'actualVolumeKgProduced' => $this->volume_kg,
            ]),
            $this->mergeWhen($this->isPlanted(), [
                'estimatedProfit' => $this->estimated_profit,
                'estimatedYieldAmount' => $this->estimated_yield_amount,
                'estimatedYieldDateEarliest' => $this->estimated_yield_date_lower_bound,
                'estimatedYieldDateLatest' => $this->estimated_yield_date_upper_bound,
            ]),
            'crop' => new CropResource($this->crop),
            'seedStage' => new SeedStageResource($this->seedStage),
            'createdAt' => $this->created_at,
        ];
    }
}
