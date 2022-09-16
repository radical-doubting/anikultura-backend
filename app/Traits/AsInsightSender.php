<?php

namespace App\Traits;

use App\Helpers\InsightsHelper;
use Illuminate\Database\Eloquent\Model;

trait AsInsightSender
{
    public function created(mixed $model): void
    {
        if (InsightsHelper::isObserverSaveMode()) {
            return;
        }

        $this->sendInsights($model, true);
    }

    public function saved(mixed $model): void
    {
        if (! InsightsHelper::isObserverSaveMode()) {
            return;
        }

        $this->sendInsights($model, true);
    }

    abstract private function sendInsights(Model $model, bool $shouldIncrement): void;
}
