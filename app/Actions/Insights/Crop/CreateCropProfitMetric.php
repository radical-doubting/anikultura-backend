<?php

namespace App\Actions\Insights\Crop;

use App\Actions\Insights\CreateInsightMetric;
use App\Models\Crop\Crop;
use InfluxDB2\Point;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateCropProfitMetric
{
    use AsAction;

    public function handle(Crop $crop): void
    {
        $profitPerKg = (float) $crop->profit_per_kg;
        $netProfitCostRatio = (float) $crop->net_profit_cost_ratio;

        $point = Point::measurement('census-crop')
            ->addField('profit-per-kg', $profitPerKg)
            ->addField('net-profit-cost-ratio', $netProfitCostRatio)
            ->addTag('crop', $crop->slug)
            ->time(time());

        CreateInsightMetric::run([$point]);
    }
}
