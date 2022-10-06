<?php

namespace App\Actions\User\Admin;

use App\Models\User\Admin\Admin;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class DeleteAdmin
{
    use AsAction;
    use AsOrchidAction;

    public function handle(Admin $admin): bool
    {
        $admin->profile->delete();

        return $admin->delete();
    }

    public function asOrchidAction(mixed $model, ?Request $request): RedirectResponse
    {
        $this->handle($model);

        Toast::info(__('Administrator was removed successfully!'));

        return redirect()->route('platform.admins');
    }
}
