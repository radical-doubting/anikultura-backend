<?php

namespace App\Actions\Insights;

use App\Helpers\InsightsHelper;
use GeTracker\InfluxDBLaravel\Facades\InfluxDB;
use InfluxDB2\WriteApi;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateInsightMetric
{
    use AsAction;

    public function handle(array $points)
    {
        if (!InsightsHelper::isInsightsEnabled()) {
            return;
        }

        $writer = $this->getWriteApi();
        $writer->write($points);
    }

    private function getWriteApi(): WriteApi
    {
        return InfluxDB::createWriteApi();
    }
}
