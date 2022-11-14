<?php

namespace App\Actions\User\Role;

use App\Models\User\Role;
use App\Models\User\User;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class CreateRole
{
    use AsAction;
    use AsOrchidAction;

    public function handle(Role $role, array $roleData, array $permissions): Role
    {
        $role->fill($roleData);

        $role->permissions = collect($permissions)
            ->map(function ($value, $key) {
                return [base64_decode($key) => $value];
            })
            ->collapse()
            ->toArray();

        $role->save();

        return $role->refresh();
    }

    public function asOrchidAction(mixed $model, ?Request $request): RedirectResponse
    {
        $this->validateIfRoleAlreadyExists($model, $request);

        $roleData = $request->get('role');
        $permissions = $request->get('permissions');

        $this->handle($model, $roleData, $permissions);

        Toast::info(__('Role was saved successfully!'));

        return redirect()->route('platform.roles');
    }

    private function validateIfRoleAlreadyExists(Role $role, Request $request): void
    {
        $request->validate([
            'role.slug' => [
                'required',
                'alpha_dash',
                'min:1',
                'max:35',
                Rule::unique(Role::class, 'slug')->ignore($role),
            ],
        ]);
    }

    public function rules(): array
    {
        return [
            'role.name' => [
                'required',
                'alpha_num_space_dash',
                'min:1',
                'max:35',
            ],
        ];
    }

    public function authorize(Request $request, mixed $model): bool
    {
        /**
         * @var User
         */
        $user = $request->user();

        return $user->canAny(['create', 'update'], $model);
    }
}
