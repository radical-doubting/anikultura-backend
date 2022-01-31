<?php

namespace App\Actions\BigBrother;

use App\Actions\User\CreateUser;
use App\Models\BigBrother\BigBrother;
use App\Traits\AsOrchidAction;
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
        $bigBrotherProfile = $bigBrother->profile();

        CreateUser::run($bigBrother, $bigBrotherData['account']);
        CreateBigBrotherProfile::run($bigBrotherProfile, $bigBrotherData['profile']);
    }

    public function asOrchidAction($model, ?Request $request)
    {
        $this->validateIfFarmerAccountExistsAlready($model, $request);

        $this->handle($model, [
            'account' => $request->get('user'),
            'profile' => $request->get('big_brother_profile'),
        ]);

        Toast::info(__('Big brother was saved successfully!'));

        return redirect()->route('platform.big-brothers');
    }

    private function validateIfFarmerAccountExistsAlready($bigBrother, Request $request)
    {
        $userNameShouldBeUnique = Rule::unique(BigBrother::class, 'name')->ignore($bigBrother);
        $emailShouldBeUnique = Rule::unique(BigBrother::class, 'email')->ignore($bigBrother);

        $request->validate([
            'user.name' => [
                'required',
                $userNameShouldBeUnique,
            ],
            'user.email' => [
                $emailShouldBeUnique,
            ],
        ]);
    }

    public function rules(): array
    {
        return [
            'big_brother_profile.age' => [
                'required',
            ],
            'big_brother_profile.organization_name' => [
                'required',
            ],
        ];
    }
}
