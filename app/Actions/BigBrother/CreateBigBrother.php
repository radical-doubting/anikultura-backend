<?php

namespace App\Actions\BigBrother;

use App\Actions\User\CreateUser;
use App\Models\BigBrother\BigBrother;
use App\Models\User;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class CreateBigBrother
{
    use AsAction;
    use AsOrchidAction;

    public function handle(BigBrother $bigBrother, array $bigBrotherData)
    {
        $createdAccountId = CreateUser::run($bigBrother, $bigBrotherData['account']);
        $createdAccount = User::find($createdAccountId);

        $this->createProfile($createdAccount, $bigBrotherData['profile']);
    }

    private function createProfile(User $createdAccount, $profileData)
    {
        $bigBrotherProfileId = CreateBigBrotherProfile::run($createdAccount->profile, $profileData);

        $createdAccount->update([
            'profile_id' => $bigBrotherProfileId,
            'profile_type' => BigBrother::$profilePath,
        ]);

        $createdAccount->refresh();
    }

    public function asOrchidAction(mixed $model, ?Request $request): RedirectResponse
    {
        $this->validateIfBigBrotherAccountExistsAlready($model, $request);

        $this->handle($model, [
            'account' => $request->get('bigBrother'),
            'profile' => $request->get('bigBrotherProfile'),
        ]);

        Toast::info(__('Big brother was saved successfully!'));

        return redirect()->route('platform.big-brothers');
    }

    private function validateIfBigBrotherAccountExistsAlready($bigBrother, Request $request)
    {
        $userNameShouldBeUnique = Rule::unique(BigBrother::class, 'name')->ignore($bigBrother);
        $emailShouldBeUnique = Rule::unique(BigBrother::class, 'email')->ignore($bigBrother);

        $request->validate([
            'bigBrother.name' => [
                'required',
                $userNameShouldBeUnique,
            ],
            'bigBrother.email' => [
                $emailShouldBeUnique,
            ],
        ]);
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
