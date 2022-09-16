<?php

namespace App\Actions\User;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class SwitchLanguage
{
    use AsAction;

    public function handle(string $language): void
    {
        if (array_key_exists($language, Config::get('languages'))) {
            Session::put('applocale', $language);
        }
    }

    public function asController(ActionRequest $request): RedirectResponse
    {
        $language = $request->route('language');

        $this->handle($language);

        return Redirect::back();
    }
}
