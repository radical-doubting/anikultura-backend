<?php

namespace App\Actions\Insights\Crop;

use App\Actions\Insights\CreateInsightMetric;
use App\Models\Batch\Batch;
use App\Models\Crop\Crop;
use App\Models\FarmerReport\FarmerReport;
use Illuminate\Support\Facades\Cache;
use InfluxDB2\Point;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateCropEstimationMetric
{
    use AsAction;

    public function handle(FarmerReport $farmerReport): void
    {
        $crop = $farmerReport->crop;
        $batch = $farmerReport->farmland->batch;

        $estimatedYieldAmount = $farmerReport->estimated_yield_amount;
        $estimatedYieldDateUpper = $farmerReport->estimated_yield_date_upper_bound;
        $estimatedYieldDateLower = $farmerReport->estimated_yield_date_lower_bound;

        $estimatedYieldDateUpperTag = $this->getEstimatedDateTag($estimatedYieldDateUpper);
        $estimatedYieldDateLowerTag = $this->getEstimatedDateTag($estimatedYieldDateLower);

        $key = $this->getKey(
            $crop,
            $estimatedYieldDateUpperTag,
            $estimatedYieldDateLowerTag,
            $batch
        );

        $newAmount = (float) $this->retrieveNewAmount(
            $key,
            $estimatedYieldAmount,
            $estimatedYieldDateUpperTag,
            $estimatedYieldDateLowerTag,
            $crop,
            $batch
        );

        Cache::put($key, $newAmount);

        $point = Point::measurement('estimation-crop')
            ->addField('estimated-yield-amount', $newAmount)
            ->addTag('crop', $crop->slug)
            ->addTag('estimated-yield-date-latest', $estimatedYieldDateUpperTag)
            ->addTag('estimated-yield-date-earliest', $estimatedYieldDateLowerTag)
            ->addTag('region', $batch->region->slug)
            ->addTag('province', $batch->province->slug)
            ->addTag('municity', $batch->municity->slug)
            ->time(time());

        CreateInsightMetric::run([$point]);
    }

    private function getKey(
        Crop $crop,
        $latestDateTag,
        $earliestDateTag,
        Batch $batch
    ) {
        $cropId = $crop->id;
        $regionId = $batch->region->id;
        $provinceId = $batch->province->id;
        $municityId = $batch->municity->id;

        return "crops:estimation-amount:$cropId:$earliestDateTag:$latestDateTag:$regionId:$provinceId:$municityId";
    }

    private function getEstimatedDateTag($estimatedDate)
    {
        return date('m-Y', strtotime($estimatedDate));
    }

    private function retrieveNewAmount(
        string $key,
        int $estimatedYieldAmount,
        string $estimatedYieldDateUpperTag,
        string $estimatedYieldDateLowerTag,
        Crop $crop,
        Batch $batch
    ) {
        if (Cache::has($key)) {
            return Cache::get($key) + $estimatedYieldAmount;
        } else {
            $masterQuery = FarmerReport::query();

            $masterQuery->where('crop_id', $crop->id);
            $masterQuery->whereHas('farmland.batch.region', function ($query) use ($batch) {
                $query->where('id', $batch->region->id);
            });
            $masterQuery->whereHas('farmland.batch.province', function ($query) use ($batch) {
                $query->where('id', $batch->province->id);
            });
            $masterQuery->whereHas('farmland.batch.municity', function ($query) use ($batch) {
                $query->where('id', $batch->municity->id);
            });

            $estimatedYieldDateUpperTagParts = explode('-', $estimatedYieldDateUpperTag);
            $masterQuery->whereMonth('estimated_yield_date_upper_bound', $estimatedYieldDateUpperTagParts[0]);
            $masterQuery->whereYear('estimated_yield_date_upper_bound', $estimatedYieldDateUpperTagParts[1]);

            $estimatedYieldDateLowerTagParts = explode('-', $estimatedYieldDateLowerTag);
            $masterQuery->whereMonth('estimated_yield_date_lower_bound', $estimatedYieldDateLowerTagParts[0]);
            $masterQuery->whereYear('estimated_yield_date_lower_bound', $estimatedYieldDateLowerTagParts[1]);

            return $masterQuery->sum('estimated_yield_amount');
        }
    }
}
