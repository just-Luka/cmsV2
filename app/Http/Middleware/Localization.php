<?php

namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Support\Facades\App;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $languageList = Language::getList();

        if (!$languageList->contains($request->locale)) {
            abort(404);
        }else {
            App::setLocale($request->locale);
            setCookie('lang', $request->locale, time() + (86400 * 7), '/');
        }

        return $next($request);
    }

}
