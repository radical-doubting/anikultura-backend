<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class SwitchLanguage
{
    use AsAction;

    public function handle(User $user, string $language): void
    {
        if (array_key_exists($language, Config::get('languages'))) {
            $user->update([
                'locale' => $language,
            ]);
        }
    }

    public function asController(ActionRequest $request): RedirectResponse
    {
        /**
         * @var User
         */
        $user = auth('web')->user();

        $language = $request->route('language');

        $this->handle($user, $language);

        return Redirect::back();
    }
}
