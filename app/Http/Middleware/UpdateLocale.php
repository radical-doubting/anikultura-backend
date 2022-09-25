<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class UpdateLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $auth = auth('web');

        if ($auth->check()) {
            $this->updateLanguage($auth->user());
        }

        return $next($request);
    }

    private function updateLanguage(User $user): void
    {
        $locale = $user->preferredLocale();

        if ($this->hasValidLanguage($locale)) {
            App::setLocale($locale);
        }
    }

    private function hasValidLanguage(string $locale): bool
    {
        return array_key_exists($locale, config('languages'));
    }
}
