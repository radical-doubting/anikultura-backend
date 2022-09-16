<?php

namespace App\Http\Middleware;

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
        if (! Session()->has('applocale')) {
            App::setLocale(config('app.fallback_locale'));

            return $next($request);
        }

        $currentLocale = Session()->get('applocale');
        $configuredLanguages = config('languages');

        if (array_key_exists($currentLocale, $configuredLanguages)) {
            App::setLocale($currentLocale);
        }

        return $next($request);
    }
}
