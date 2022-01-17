<?php

namespace App\Actions\Insights;

use InfluxDB\Database;
use InfluxDB\Point;
use Lorisleiva\Actions\Concerns\AsAction;
use TrayLabs\InfluxDB\Facades\InfluxDB;

class CreateInsight
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
        $precision = Database::PRECISION_SECONDS;

        return InfluxDB::writePoints($points, $precision);
    }
}
