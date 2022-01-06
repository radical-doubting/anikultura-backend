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
     * @param Model $model
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public static function runOrchidAction($model, ?Request $request)
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
    public function handleAsOrchidAction($model, ?Request $request)
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
        $rules = $this->rules();

        if (!isset($rules)) {
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
    abstract public function asOrchidAction($model, ?Request $request);
}
