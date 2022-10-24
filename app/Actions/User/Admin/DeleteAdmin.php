<?php

namespace App\Actions\User\Admin;

use App\Helpers\ToastHelper;
use App\Models\User\Admin\Admin;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;
use PDOException;

class DeleteAdmin
{
    use AsAction;
    use AsOrchidAction;

    public function handle(Admin $admin): bool
    {
        $admin->delete();

        return $admin->profile->delete();
    }

    public function asOrchidAction(mixed $model, ?Request $request): RedirectResponse
    {
        try {
            $this->handle($model);
        } catch (PDOException $exception) {
            ToastHelper::showReferenceDeleteError('administrator');

            return redirect()->route('platform.admins.edit', [
                $model->id,
            ]);
        }

        Toast::info(__('Administrator was removed successfully!'));

        return redirect()->route('platform.admins');
    }
}
