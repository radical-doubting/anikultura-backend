<?php

namespace App\Traits;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

trait AsOrchidAction
{
    /**
     * A static helper that runs the action as an Orchid business logic.
     */
    public static function runOrchidAction(mixed $model, ?Request $request): RedirectResponse
    {
        return static::make()->handleAsOrchidAction($model, $request);
    }

    /**
     * Runs the action as an Orchid business logic.
     */
    public function handleAsOrchidAction(mixed $model, ?Request $request): RedirectResponse
    {
        if (isset($request)) {
            $this->validateRequest($request);
        }

        return $this->asOrchidAction($model, $request);
    }

    /**
     * Validates the request with the `rules` array method if it exists.
     */
    private function validateRequest(Request $request): void
    {
        if (! method_exists($this, 'rules')) {
            return;
        }

        $rules = $this->rules();

        if (! is_array($rules)) {
            return;
        }

        $request->validate($rules);
    }

    /**
     * Runs the action as an Orchid business logic.
     */
    abstract public function asOrchidAction(mixed $model, ?Request $request): RedirectResponse;
}
