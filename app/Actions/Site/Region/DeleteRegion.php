<?php

namespace App\Actions\Site\Region;

use App\Helpers\ToastHelper;
use App\Models\Site\Region;
use App\Models\User\User;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;
use PDOException;

class DeleteRegion
{
    use AsAction;
    use AsOrchidAction;

    public function handle(Region $region): bool
    {
        $isDeleted = $region->delete();

        if (is_null($isDeleted)) {
            return false;
        }

        return $isDeleted;
    }

    public function asOrchidAction(mixed $model, ?Request $request): RedirectResponse
    {
        try {
            $this->handle($model);
        } catch (PDOException $exception) {
            ToastHelper::showReferenceDeleteError('region');

            return redirect()->route('platform.sites.regions.edit', [
                $model->id,
            ]);
        }

        Toast::info(__('Region was removed successfully!'));

        return redirect()->route('platform.sites.regions');
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
