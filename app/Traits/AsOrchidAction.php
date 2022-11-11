<?php

namespace App\Traits;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

trait AsOrchidAction
{
    /**
     * A static helper that runs the action as an Orchid business logic.
     */
    public static function runOrchidAction(mixed $model, Request $request): RedirectResponse
    {
        return static::make()->handleAsOrchidAction($model, $request);
    }

    /**
     * Runs the action as an Orchid business logic.
     */
    public function handleAsOrchidAction(mixed $model, Request $request): RedirectResponse
    {
        if (isset($request)) {
            $this->validateRequest($request);
            $this->validateAuthorization($request, $model);
        }

        return $this->asOrchidAction($model, $request);
    }

    /**
     * Validates the request with the `rules` array method if it exists.
     */
    private function validateRequest(Request $request): void
    {
        $rules = $this->rules();
        $messages = $this->getValidationMessages();
        $attributes = $this->getValidationAttributes();

        if (config('app.debug')) {
            $this->debugValidation($request, $rules);
        }

        $request->validate($rules, $messages, $attributes);
    }

    public function rules(): array
    {
        return [];
    }

    public function getValidationMessages(): array
    {
        return [];
    }

    public function getValidationAttributes(): array
    {
        return [];
    }

    private function validateAuthorization(Request $request, mixed $model): void
    {
        if (! $this->authorize($request, $model)) {
            abort(403, 'This action is unauthorized.');
        }
    }

    public function authorize(Request $request, mixed $model): bool
    {
        return true;
    }

    private function debugValidation(Request $request, array $rules)
    {
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Log::error($validator->failed());
        }
    }

    /**
     * Runs the action as an Orchid business logic.
     */
    abstract public function asOrchidAction(mixed $model, Request $request): RedirectResponse;
}
