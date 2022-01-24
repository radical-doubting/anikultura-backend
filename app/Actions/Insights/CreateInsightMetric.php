<?php

namespace App\Actions\Insights;

use GeTracker\InfluxDBLaravel\Facades\InfluxDB;
use InfluxDB2\WriteApi;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateInsightMetric
{
    use AsAction;

    public function handle(array $points)
    {
        if (!$this->isInsightsEnabled()) {
            return;
        }

        $writer = $this->getWriteApi();
        $writer->write($points);
    }

    private function isInsightsEnabled()
    {
        return config('influxdb.enabled');
    }

    private function getWriteApi(): WriteApi
    {
        return InfluxDB::createWriteApi();
    }
}
