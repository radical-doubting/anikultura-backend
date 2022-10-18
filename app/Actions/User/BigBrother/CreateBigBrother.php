<?php

namespace App\Actions\User\BigBrother;

use App\Actions\User\CreateUser;
use App\Actions\User\ValidateUserAccount;
use App\Models\User\BigBrother\BigBrother;
use App\Models\User\BigBrother\BigBrotherProfile;
use App\Models\User\Role;
use App\Models\User\User;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class CreateBigBrother
{
    use AsAction;
    use AsOrchidAction;

    public function __construct(
        protected CreateUser $createUser,
        protected CreateBigBrotherProfile $createBigBrotherProfile,
        protected ValidateUserAccount $validateUserAccount,
    ) {
    }

    public function handle(BigBrother $bigBrother, array $bigBrotherData): BigBrother
    {
        $createdAccount = $this->createUser->handle(
            $bigBrother,
            $bigBrotherData['account']
        );

        $bigBrotherProfile = $this->createProfileOrUpdate($createdAccount);

        $updatedBigBrotherProfile = $this->createBigBrotherProfile->handle(
            $bigBrotherProfile,
            $bigBrotherData['profile']
        );

        $this->updateProfileType($createdAccount, $updatedBigBrotherProfile);

        return $bigBrother->refresh();
    }

    private function createProfileOrUpdate(User $createdAccount): BigBrotherProfile
    {
        $bigBrotherProfile = $createdAccount->profile;

        return is_null($bigBrotherProfile) ? new BigBrotherProfile() : $bigBrotherProfile;
    }

    private function updateProfileType(User $createdAccount, BigBrotherProfile $bigBrotherProfile)
    {
        $createdAccount->update([
            'profile_id' => $bigBrotherProfile->id,
            'profile_type' => BigBrother::PROFILE_PATH,
        ]);

        $createdAccount->roles()->sync(Role::bigBrother());
    }

    public function asOrchidAction(mixed $model, ?Request $request): RedirectResponse
    {
        $this->validateUserAccount->handle(
            $model,
            'bigBrother',
            BigBrother::class,
            $request
        );

        $this->handle($model, [
            'account' => $request->get('bigBrother'),
            'profile' => $request->get('bigBrotherProfile'),
        ]);

        Toast::info(__('Big brother was saved successfully!'));

        return redirect()->route('platform.big-brothers');
    }

    public function rules(): array
    {
        return [
            'bigBrotherProfile.age' => [
                'required',
            ],
            'bigBrotherProfile.organization_name' => [
                'required',
            ],
        ];
    }
}
