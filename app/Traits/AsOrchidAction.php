<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

trait AsOrchidAction
{
    /**
     * A static helper that runs the action as an Orchid business logic.
     *
     * @param Model   $model
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public static function runOrchidAction(Model $model, Request $request = null): RedirectResponse
    {
        return static::make()->handleAsOrchidAction($model, $request);
    }

    /**
     * Runs the action as an Orchid business logic.
     *
     * @param Model   $model
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function handleAsOrchidAction(Model $model, Request $request = null): RedirectResponse
    {
        $this->validateRequest($request);

        return $this->asOrchidAction($model, $request);
    }

    /**
     * Validates the request with the `rules` array method if it exists.
     */
    private function validateRequest(Request $request): void
    {
        if (!defined($request)) {
            return;
        }

        $rules = $this->rules();

        if (!defined($rules)) {
            return;
        }

        $request->validate($rules);
    }

    /**
     * Runs the action as an Orchid business logic.
     *
     * @param Model   $model
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    abstract public function asOrchidAction(Model $model, Request $request): RedirectResponse;
}
