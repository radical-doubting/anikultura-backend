<?php

namespace App\Actions\Crop;

use App\Models\Crop\Crop;
use App\Models\Farmland\Farmland;
use Lorisleiva\Actions\Concerns\AsAction;

class CalculateExpectedYieldAmount
{
    use AsAction;

    public function handle(Farmland $farmland, Crop $crop)
    {
        $hectares = $farmland->hectares_size;
        $yieldPerHectares = $crop->yield_per_ha;

        return $hectares * $yieldPerHectares;
    }
}
