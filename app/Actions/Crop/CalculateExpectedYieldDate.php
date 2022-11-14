<?php

namespace App\Actions\Crop;

use App\Models\Crop\Crop;
use DateInterval;
use DateTime;
use Lorisleiva\Actions\Concerns\AsAction;

class CalculateExpectedYieldDate
{
    use AsAction;

    public function handle(Crop $crop, DateTime $datePlanted)
    {
        $maturityUpperBound = $crop->maturity_upper_bound;
        $maturityLowerBound = $crop->maturity_lower_bound;

        return [
            'upper' => $this->estimateDate($datePlanted, $maturityUpperBound),
            'lower' => $this->estimateDate($datePlanted, $maturityLowerBound),
        ];
    }

    private function estimateDate(DateTime $datePlanted, int $maturity)
    {
        $estimatedDate = clone $datePlanted;
        $estimatedDate->add(new DateInterval('P'.$maturity.'D'));

        return strtolower($estimatedDate->format('Y-m-d'));
    }
}
