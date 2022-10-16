<?php

namespace App\Actions\User;

use App\Models\User\User;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class EditUserProfile
{
    use AsAction;
    use AsOrchidAction;

    public function handle(User $user, array $userData): void
    {
        $user
            ->fill($userData)
            ->save();
    }

    public function asOrchidAction(mixed $model, ?Request $request): RedirectResponse
    {
        /**
         * @var User
         */
        $user = $request->user();

        $this->validateIfUserEmailExistsAlready($user, $request);

        $userData = $request->get('user');

        $this->handle($user, $userData);

        Toast::info(__('Profile updated.'));

        return redirect()->route('platform.profile');
    }

    private function validateIfUserEmailExistsAlready(User $user, Request $request): void
    {
        $emailShouldBeUnique = Rule::unique(User::class, 'email')->ignore($user);

        $request->validate([
            'user.name' => [
                'required',
                'alpha_num',
            ],
            'user.email' => [
                'required',
                'email',
                $emailShouldBeUnique,
            ],
        ]);
    }
}
