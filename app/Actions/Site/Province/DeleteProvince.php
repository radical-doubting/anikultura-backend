<?php

namespace App\Actions\Site\Province;

use App\Helpers\ToastHelper;
use App\Models\Site\Province;
use App\Models\User\User;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;
use PDOException;

class DeleteProvince
{
    use AsAction;
    use AsOrchidAction;

    public function handle(Province $province): bool
    {
        $isDeleted = $province->delete();

        if (is_null($isDeleted)) {
            return false;
        }

        return $isDeleted;
    }

    public function asOrchidAction(mixed $model, Request $request): RedirectResponse
    {
        try {
            $this->handle($model);
        } catch (PDOException $exception) {
            ToastHelper::showReferenceDeleteError('province');

            return redirect()->route('platform.sites.provinces.edit', [
                $model->id,
            ]);
        }

        Toast::info(__('Province was removed successfully!'));

        return redirect()->route('platform.sites.provinces');
    }

    public function authorize(Request $request, mixed $model): bool
    {
        /**
         * @var User
         */
        $user = $request->user();

        return $user->can('delete', $model);
    }
}
