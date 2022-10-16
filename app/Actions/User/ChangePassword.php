<?php

namespace App\Actions\User;

use App\Actions\Authentication\HashPassword;
use App\Helpers\PasswordRuleHelper;
use App\Models\User\User;
use App\Traits\AsOrchidAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Orchid\Support\Facades\Toast;

class ChangePassword
{
    use AsAction;
    use AsOrchidAction;

    public function __construct(
        protected HashPassword $hashPassword
    ) {
    }

    public function handle(User $user, string $plaintextPassword): void
    {
        tap($user, function ($user) use ($plaintextPassword) {
            $user->password = $this->hashPassword->handle($plaintextPassword);
        })->save();
    }

    public function asOrchidAction(mixed $model, ?Request $request): RedirectResponse
    {
        /**
         * @var User
         */
        $user = $request->user();
        $plaintextPassword = $request->get('password');

        $this->handle($user, $plaintextPassword);

        Toast::info(__('Password changed.'));

        return redirect()->route('platform.profile');
    }

    public function rules(): array
    {
        return [
            'old_password' => [
                'required',
                'current_password:web',
            ],
            'password' => [
                'required',
                'confirmed',
                PasswordRuleHelper::getRule(),
            ],
        ];
    }
}
