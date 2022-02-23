<?php

namespace App\Actions\Crop;

use App\Models\Crop\Crop;
use Lorisleiva\Actions\Concerns\AsAction;

class CalculateNetProfitCostRatio
{
    use AsAction;

    public function handle(Crop $crop)
    {
        $netReturns = $crop->net_returns_per_ha;
        $totalCosts = $crop->total_costs_per_ha;

        return round($netReturns / $totalCosts, 4);
    }
}
