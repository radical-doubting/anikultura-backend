<?php

namespace App\Actions\User\Role;

use App\Models\User\Role;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class DeleteRole
{
    use AsAction;
    use AsOrchidAction;

    public function handle(Role $role): bool
    {
        return $role->delete();
    }

    public function asOrchidAction(mixed $model, ?Request $request): RedirectResponse
    {
        $this->handle($model);

        Toast::info(__('Role was removed'));

        return redirect()->route('platform.roles');
    }
}
