<?php

namespace App\Actions\Insights;

use App\Models\Crop\Crop;
use InfluxDB2\Point;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateCropMetric
{
    use AsAction;

    public function handle(Crop $crop): void
    {
        $point = Point::measurement('census-crop')
            ->addField('profit-per-kg', $crop->profit_per_kg)
            ->addField('net-profit-cost-ratio', $crop->net_profit_cost_ratio)
            ->addTag('crop', $crop->slug)
            ->time(time());

        CreateInsightMetric::run([$point]);
    }
}
