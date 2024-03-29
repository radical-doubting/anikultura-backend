<?php

namespace App\Actions\User\Admin;

use App\Actions\User\CreateUser;
use App\Actions\User\ValidateUserAccount;
use App\Models\User\Admin\Admin;
use App\Models\User\Admin\AdminProfile;
use App\Models\User\Role;
use App\Models\User\User;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class CreateAdmin
{
    use AsAction;
    use AsOrchidAction;

    public function __construct(
        protected CreateUser $createUser,
        protected CreateAdminProfile $createAdminProfile,
        protected ValidateUserAccount $validateUserAccount,
    ) {
    }

    public function handle(Admin $admin, array $adminData): Admin
    {
        $createdAccount = $this->createUser->handle(
            $admin,
            $this->handlePermissions($adminData['account']),
        );

        $adminProfile = $this->createProfileOrUpdate($createdAccount);

        $updatedAdminProfile = $this->createAdminProfile->handle(
            $adminProfile,
            $adminData['profile']
        );

        $this->updateProfileType($createdAccount, $updatedAdminProfile);

        return $admin->refresh();
    }

    private function handlePermissions(array $accountData): array
    {
        $permissions = collect($accountData['permissions'])
            ->map(function ($value, $key) {
                return [base64_decode($key) => $value];
            })
            ->collapse()
            ->toArray();

        $accountData['permissions'] = $permissions;

        return $accountData;
    }

    private function createProfileOrUpdate(User $createdAccount): AdminProfile
    {
        $adminProfile = $createdAccount->profile;

        return is_null($adminProfile) ? new AdminProfile() : $adminProfile;
    }

    private function updateProfileType(User $createdAccount, AdminProfile $adminProfile)
    {
        $createdAccount->update([
            'profile_id' => $adminProfile->id,
            'profile_type' => Admin::PROFILE_PATH,
        ]);

        $createdAccount->roles()->sync(Role::admin());
    }

    public function asOrchidAction(mixed $model, ?Request $request): RedirectResponse
    {
        $this->validateUserAccount->handle(
            $model,
            'admin',
            Admin::class,
            $request
        );

        $this->handle($model, [
            'account' => $request->get('admin'),
            'profile' => $request->get('adminProfile'),
        ]);

        Toast::info(__('Administrator was saved successfully!'));

        return redirect()->route('platform.admins');
    }

    public function rules(): array
    {
        return [
            'adminProfile.age' => [
                'required',
            ],
            'admin.permissions' => [
                'required',
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
