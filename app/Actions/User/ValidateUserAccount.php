<?php

namespace App\Actions\User;

use App\Helpers\PasswordRuleHelper;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Lorisleiva\Actions\Concerns\AsAction;

class ValidateUserAccount
{
    use AsAction;

    public function handle(User $user, string $userType, string $userClass, Request $request): void
    {
        $userNameShouldBeUnique = Rule::unique($userClass, 'name')->ignore($user);
        $emailShouldBeUnique = Rule::unique($userClass, 'email')->ignore($user);

        $request->validate([
            "$userType.name" => [
                'required',
                'alpha_num',
                $userNameShouldBeUnique,
            ],
            "$userType.first_name" => [
                'required',
                'alpha_num_space_dash',
                'min:1',
                'max:35',
            ],
            "$userType.middle_name" => [
                'nullable',
                'alpha_num_space_dash',
                'min:1',
                'max:35',
            ],
            "$userType.last_name" => [
                'required',
                'alpha_num_space_dash',
                'min:1',
                'max:35',
            ],
            "$userType.email" => [
                'email',
                $emailShouldBeUnique,
            ],
            "$userType.password" => [
                'nullable',
                PasswordRuleHelper::getRule(),
            ],
        ]);
    }
}
