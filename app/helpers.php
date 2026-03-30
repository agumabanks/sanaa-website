<?php

if (!function_exists('cdn_asset')) {
    /**
     * Generate CDN URL for asset
     *
     * @param string $path
     * @return string
     */
    function cdn_asset($path)
    {
        return app('cdn')->asset($path);
    }
}

if (!function_exists('cdn_storage')) {
    /**
     * Generate CDN URL for storage asset
     *
     * @param string $path
     * @return string
     */
    function cdn_storage($path)
    {
        return app('cdn')->storage($path);
    }
}

if (!function_exists('cdn_url')) {
    /**
     * Get CDN base URL
     *
     * @return string|null
     */
    function cdn_url()
    {
        return app('cdn')->getUrl();
    }
}

if (!function_exists('cdn_enabled')) {
    /**
     * Check if CDN is enabled
     *
     * @return bool
     */
    function cdn_enabled()
    {
        return app('cdn')->isEnabled();
    }
}

if (!function_exists('soko_domain_url')) {
    /**
     * Build an absolute URL to the active Soko domain with an optional path.
     * Falls back to soko.sanaa.ug when domain settings are not configured.
     */
    function soko_domain_url(string $path = ''): string
    {
        try {
            $domain = \App\Services\DomainService::getSokoDomain();
        } catch (\Throwable $e) {
            $domain = 'soko.sanaa.ug';
        }

        $scheme = request()?->isSecure() ? 'https://' : 'https://';
        $path = ltrim($path, '/');

        return rtrim($scheme . $domain, '/') . ($path ? '/' . $path : '');
    }
}

if (!function_exists('isActiveRoute')) {
    /**
     * Check if the given route name or pattern matches the current route
     *
     * @param string|array $routes Route name(s) or pattern(s)
     * @param bool $strict Strict matching (default: false)
     * @return bool
     */
    function isActiveRoute($routes, bool $strict = false): bool
    {
        $routes = is_array($routes) ? $routes : [$routes];
        $currentRoute = request()->route()?->getName();

        if (!$currentRoute) {
            return false;
        }

        foreach ($routes as $route) {
            if ($strict) {
                if ($currentRoute === $route) {
                    return true;
                }
            } else {
                // Support wildcard patterns like 'blog.*'
                $pattern = str_replace('*', '.*', $route);
                if (preg_match('/^' . $pattern . '$/', $currentRoute)) {
                    return true;
                }
            }
        }

        return false;
    }
}

if (!function_exists('isActiveUrl')) {
    /**
     * Check if the given URL matches the current request URL
     *
     * @param string $url URL to check
     * @param bool $exact Exact match (default: false)
     * @return bool
     */
    function isActiveUrl(string $url, bool $exact = false): bool
    {
        $currentUrl = request()->url();
        $currentPath = request()->path();

        // Normalize URLs
        $url = rtrim($url, '/');
        $currentUrl = rtrim($currentUrl, '/');

        if ($exact) {
            return $currentUrl === $url || url($url) === $currentUrl;
        }

        // Check if current path starts with the given URL path
        $urlPath = parse_url($url, PHP_URL_PATH) ?? $url;
        $urlPath = ltrim($urlPath, '/');

        return str_starts_with($currentPath, $urlPath);
    }
}

if (!function_exists('navActiveClass')) {
    /**
     * Get active class for navigation items
     *
     * @param string|array $routes Route name(s) or URL
     * @param string $activeClass Active class name (default: 'active')
     * @param string $type 'route' or 'url' (default: 'route')
     * @return string
     */
    function navActiveClass($routes, string $activeClass = 'active', string $type = 'route'): string
    {
        $isActive = $type === 'url'
            ? isActiveUrl($routes)
            : isActiveRoute($routes);

        return $isActive ? $activeClass : '';
    }
}