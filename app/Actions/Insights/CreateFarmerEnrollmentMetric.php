<?php

namespace App\Actions\Insights;

use App\Models\Batch\Batch;
use Illuminate\Support\Facades\Cache;
use InfluxDB2\Point;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateFarmerEnrollmentMetric
{
    use AsAction;

    public function handle(Batch $batch, array $farmerIds): void
    {
        $key = "farmers:count:$batch->id";
        $newCount = $this->retrieveNewCount($key, $batch, $farmerIds);

        Cache::put($key, $newCount);

        $point = Point::measurement('census-farmer')
            ->addField('count', $newCount)
            ->addTag('batch', $batch->slug)
            ->addTag('region', $batch->region->slug)
            ->addTag('province', $batch->province->slug)
            ->addTag('municity', $batch->municity->slug)
            ->time(time());

        CreateInsightMetric::run([$point]);
    }

    private function retrieveNewCount(string $key, Batch $batch, array $farmerIds): int
    {
        if (Cache::has($key)) {
            return Cache::get($key) + count($farmerIds);
        } else {
            return $batch->farmers->count();
        }
    }
}
