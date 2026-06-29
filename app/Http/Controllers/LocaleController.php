<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class LocaleController extends Controller
{
    /**
     * Set the application locale and redirect back.
     */
    public function set(Request $request, string $locale): RedirectResponse
    {
        $supported = ['en', 'fr', 'sw'];
        if (! in_array($locale, $supported, true)) {
            $locale = config('app.fallback_locale');
        }

        session(['locale' => $locale]);

        $redirect = $this->resolveRedirectTarget($request, $locale, $supported);

        return redirect()->to($redirect);
    }

    private function resolveRedirectTarget(Request $request, string $locale, array $supported): string
    {
        $fallback = config('app.fallback_locale', 'en');
        $defaultTarget = route('home', ['locale' => $locale !== $fallback ? $locale : null]);

        $candidate = $request->query('redirect');
        if (! is_string($candidate) || ! filter_var($candidate, FILTER_VALIDATE_URL)) {
            $candidate = url()->previous();
        }

        if (! is_string($candidate) || ! filter_var($candidate, FILTER_VALIDATE_URL)) {
            return $defaultTarget;
        }

        $parts = parse_url($candidate);
        if (! is_array($parts)) {
            return $defaultTarget;
        }

        $candidateHost = $parts['host'] ?? null;
        $requestHost = $request->getHost();
        $appHost = parse_url(config('app.url', ''), PHP_URL_HOST);
        if ($candidateHost && ! in_array($candidateHost, array_filter([$requestHost, $appHost]), true)) {
            return $defaultTarget;
        }

        $path = $parts['path'] ?? '/';
        $trimmedPath = trim($path, '/');
        if (in_array($trimmedPath, $supported, true)) {
            $path = $locale !== $fallback ? '/' . $locale : '/';
        }

        parse_str($parts['query'] ?? '', $query);
        Arr::forget($query, 'lang');
        $queryString = http_build_query($query);

        $scheme = $parts['scheme'] ?? $request->getScheme();
        $host = $candidateHost ?? $requestHost;
        $port = isset($parts['port']) ? ':' . $parts['port'] : '';
        $fragment = isset($parts['fragment']) ? '#' . $parts['fragment'] : '';

        return $scheme . '://' . $host . $port . $path . ($queryString ? '?' . $queryString : '') . $fragment;
    }
}
