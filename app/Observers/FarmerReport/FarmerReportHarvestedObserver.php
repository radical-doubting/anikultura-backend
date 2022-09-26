<?php

namespace App\Observers\FarmerReport;

use App\Events\ReadyForHarvestEvent;
use App\Models\FarmerReport\FarmerReport;

class FarmerReportHarvestedObserver
{
    /**
     * @param  FarmerReport  $model
     */
    public function created(mixed $model): void
    {
        if ($model->isHarvested() == true) {
            event(new ReadyForHarvestEvent($model));
        }
    }
}
