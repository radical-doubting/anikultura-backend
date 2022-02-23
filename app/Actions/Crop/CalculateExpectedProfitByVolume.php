<?php

namespace App\Actions\Crop;

use App\Models\Crop\Crop;
use Lorisleiva\Actions\Concerns\AsAction;

class CalculateExpectedProfitByVolume
{
    use AsAction;

    public function handle(float $volume, Crop $crop)
    {
        $profitPerKg = $crop->profit_per_kg;

        return $volume * $profitPerKg;
    }
}
