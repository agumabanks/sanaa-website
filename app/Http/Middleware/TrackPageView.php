<?php

namespace App\Http\Middleware;

use App\Models\PageView;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackPageView
{
    /**
     * Routes to exclude from tracking
     */
    protected array $excludedRoutes = [
        'api.*',
        'livewire.*',
        'login',
        'logout',
        'password.*',
        'verification.*',
        'admin.*',
        'teller.*',
        'ignition.*',
    ];

    /**
     * Paths to exclude from tracking
     */
    protected array $excludedPaths = [
        '_debugbar',
        'build',
        'storage',
        'css',
        'js',
        'images',
        'fonts',
        'favicon',
    ];

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only track GET requests that return HTML
        if ($request->isMethod('GET') && $this->shouldTrack($request, $response)) {
            $this->trackView($request);
        }

        return $response;
    }

    /**
     * Determine if the request should be tracked
     */
    protected function shouldTrack(Request $request, Response $response): bool
    {
        // Only track successful HTML responses
        if ($response->getStatusCode() !== 200) {
            return false;
        }

        // Check if it's a JSON or API response
        if ($request->expectsJson() || $request->is('api/*')) {
            return false;
        }

        // Check excluded routes
        $routeName = $request->route()?->getName();
        if ($routeName) {
            foreach ($this->excludedRoutes as $pattern) {
                if (fnmatch($pattern, $routeName)) {
                    return false;
                }
            }
        }

        // Check excluded paths
        $path = $request->path();
        foreach ($this->excludedPaths as $excludedPath) {
            if (str_starts_with($path, $excludedPath)) {
                return false;
            }
        }

        // Don't track bots
        $userAgent = strtolower($request->userAgent() ?? '');
        $bots = ['bot', 'crawler', 'spider', 'slurp', 'googlebot', 'bingbot'];
        foreach ($bots as $bot) {
            if (str_contains($userAgent, $bot)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Track the page view
     */
    protected function trackView(Request $request): void
    {
        try {
            PageView::create([
                'page_url' => $request->fullUrl(),
                'page_title' => $this->getPageTitle($request),
                'route_name' => $request->route()?->getName(),
                'ip_address' => $request->ip(),
                'user_agent' => substr($request->userAgent() ?? '', 0, 500),
                'referrer' => $request->header('referer') ? substr($request->header('referer'), 0, 500) : null,
                'user_id' => auth()->id(),
                'session_id' => session()->getId(),
                'device_type' => $this->getDeviceType($request),
                'browser' => $this->getBrowser($request),
            ]);
        } catch (\Exception $e) {
            // Silently fail - don't break the page for analytics
            report($e);
        }
    }

    /**
     * Get the page title from the route
     */
    protected function getPageTitle(Request $request): ?string
    {
        $routeName = $request->route()?->getName();
        if ($routeName) {
            // Convert route name to readable title
            $title = str_replace(['.', '-', '_'], ' ', $routeName);
            return ucwords($title);
        }
        return null;
    }

    /**
     * Detect device type from user agent
     */
    protected function getDeviceType(Request $request): string
    {
        $userAgent = strtolower($request->userAgent() ?? '');
        
        if (str_contains($userAgent, 'mobile') || str_contains($userAgent, 'android')) {
            return 'mobile';
        }
        
        if (str_contains($userAgent, 'tablet') || str_contains($userAgent, 'ipad')) {
            return 'tablet';
        }
        
        return 'desktop';
    }

    /**
     * Extract browser name from user agent
     */
    protected function getBrowser(Request $request): ?string
    {
        $userAgent = $request->userAgent() ?? '';
        
        $browsers = [
            'Chrome' => '/Chrome\/[\d.]+/i',
            'Firefox' => '/Firefox\/[\d.]+/i',
            'Safari' => '/Safari\/[\d.]+/i',
            'Edge' => '/Edg\/[\d.]+/i',
            'Opera' => '/OPR\/[\d.]+/i',
            'IE' => '/MSIE|Trident/i',
        ];

        foreach ($browsers as $name => $pattern) {
            if (preg_match($pattern, $userAgent)) {
                return $name;
            }
        }

        return null;
    }
}
