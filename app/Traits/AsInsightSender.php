<?php

namespace App\Traits;

use App\Enums\InsightsMode;
use App\Facades\Anikultura;
use Illuminate\Database\Eloquent\Model;

trait AsInsightSender
{
    public function created(mixed $model): void
    {
        if ($this->isModelSaveMode()) {
            return;
        }

        $this->sendInsights($model, true);
    }

    public function saved(mixed $model): void
    {
        if (! $this->isModelSaveMode()) {
            return;
        }

        $this->sendInsights($model, true);
    }

    private function isModelSaveMode(): bool
    {
        return Anikultura::getInsightsMode() === InsightsMode::MODEL_SAVE;
    }

    abstract private function sendInsights(Model $model, bool $shouldIncrement): void;
}
