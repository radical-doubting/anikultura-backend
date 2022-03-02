<?php

namespace App\Actions\Crop;

use App\Models\Crop\Crop;
use Lorisleiva\Actions\Concerns\AsAction;

class CalculateProfitPerKilogram
{
    use AsAction;

    public function handle(Crop $crop)
    {
        $productionCost = $crop->production_cost_per_kg;
        $farmGatePrice = $crop->farmgate_price_per_kg;

        return $farmGatePrice - $productionCost;
    }
}
