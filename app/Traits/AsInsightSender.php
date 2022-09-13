<?php

namespace App\Traits;

use App\Helpers\InsightsHelper;
use Illuminate\Database\Eloquent\Model;

trait AsInsightSender
{
    public function created($model)
    {
        if (InsightsHelper::isObserverSaveMode()) {
            return;
        }

        $this->sendInsights($model, true);
    }

    public function saved($model)
    {
        if (! InsightsHelper::isObserverSaveMode()) {
            return;
        }

        $this->sendInsights($model, true);
    }

    abstract private function sendInsights(Model $model, bool $shouldIncrement);
}
