<?php

namespace App\Actions\Insights;

use GeTracker\InfluxDBLaravel\Facades\InfluxDB;
use InfluxDB2\Point;
use InfluxDB2\WriteApi;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateInsightMetric
{
    use AsAction;

    public function handle(
        string $measurementName,
        $measurementValue = null,
        array $tags = [],
        array $fields = []
    ) {
        $points = [
            new Point($measurementName, $measurementValue, $tags, $fields, time()),
        ];

        $writer = $this->getWriteApi();
        $writer->write($points);
    }

    private function getWriteApi(): WriteApi
    {
        return InfluxDB::createWriteApi();
    }
}
