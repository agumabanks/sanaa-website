<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    /**
     * Set the application locale and redirect back.
     */
    public function set(Request $request, string $locale): RedirectResponse
    {
        $supported = ['en', 'fr', 'es', 'sw'];
        if (! in_array($locale, $supported, true)) {
            $locale = config('app.fallback_locale');
        }

        session(['locale' => $locale]);

        // Optionally allow redirect to a specific URL
        $redirect = $request->query('redirect');
        if ($redirect && filter_var($redirect, FILTER_VALIDATE_URL)) {
            return redirect()->to($redirect);
        }

        return back();
    }
}

