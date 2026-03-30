<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $supported = ['en', 'fr', 'sw'];
        $locale = null;

        // 1. Check URL segment (e.g., /fr/...)
        $segment = $request->segment(1);
        if (in_array($segment, $supported, true)) {
            $locale = $segment;
        }

        // 2. Fallback to query param (e.g., ?lang=fr)
        if (!$locale) {
            $queryLocale = $request->query('lang');
            if ($queryLocale && in_array($queryLocale, $supported, true)) {
                $locale = $queryLocale;
            }
        }

        // 3. Fallback to session
        if (!$locale) {
            $locale = session('locale');
        }

        // 4. Default to config
        if (!$locale || !in_array($locale, $supported, true)) {
            $locale = config('app.locale', 'en');
        }

        // Store in session and set app locale
        session(['locale' => $locale]);
        app()->setLocale($locale);

        return $next($request);
    }
}
