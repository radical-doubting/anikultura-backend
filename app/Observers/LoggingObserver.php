<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class LoggingObserver
{
    /**
     * @param  Model  $model
     */
    public function created(mixed $model): void
    {
        Log::info($this->getFormattedName($model).' created');
    }

    /**
     * @param  Model  $model
     */
    public function updated(mixed $model): void
    {
        Log::info($this->getFormattedName($model).' updated');
    }

    /**
     * @param  Model  $model
     */
    public function deleted(mixed $model): void
    {
        Log::info($this->getFormattedName($model).' deleted');
    }

    private function getFormattedName(Model $model): string
    {
        $singular = Str::singular($model->getTable());

        return Str::headline($singular);
    }
}
