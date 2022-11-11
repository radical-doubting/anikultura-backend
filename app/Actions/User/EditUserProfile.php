<?php

namespace App\Actions\User;

use App\Models\User\User;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class EditUserProfile
{
    use AsAction;
    use AsOrchidAction;

    public function __construct(
        protected ValidateUserAccount $validateUserAccount,
    ) {
    }

    public function handle(User $user, array $userData): void
    {
        $user
            ->fill($userData)
            ->save();
    }

    public function asOrchidAction(mixed $model, Request $request): RedirectResponse
    {
        /**
         * @var User
         */
        $user = $request->user();

        $this->validateUserAccount->handle(
            $user,
            'user',
            User::class,
            $request
        );

        $userData = $request->get('user');

        $this->handle($user, $userData);

        Toast::info(__('Profile updated.'));

        return redirect()->route('platform.profile');
    }
}
