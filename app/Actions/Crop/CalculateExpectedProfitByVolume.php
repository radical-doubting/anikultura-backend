<?php

namespace App\Actions\Crop;

use App\Models\Crop\Crop;
use Lorisleiva\Actions\Concerns\AsAction;

class CalculateExpectedProfitByVolume
{
    use AsAction;

    public function handle(Crop $crop, float $volume)
    {
        $profitPerKg = $crop->profit_per_kg;

        return round($volume * $profitPerKg, 2);
    }
}
