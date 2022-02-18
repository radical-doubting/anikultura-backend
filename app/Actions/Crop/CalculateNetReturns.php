<?php

namespace App\Actions\Crop;

use App\Models\Crop\Crop;
use Lorisleiva\Actions\Concerns\AsAction;

class CalculateNetReturns
{
    use AsAction;

    public function handle(Crop $crop)
    {
        $grossReturns = $crop->gross_returns_per_ha;
        $totalCosts = $crop->total_costs_per_ha;

        return $grossReturns - $totalCosts;
    }
}
