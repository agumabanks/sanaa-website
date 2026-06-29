<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CacheControl
{
    /**
     * Public routes that should be cached by CDNs/browsers
     */
    private const PUBLIC_ROUTES = [
        'home',
        'about',
        'company',
        'products',
        'services',
        'careers',
        'partners',
        'team.index',
        'contact',
        'support',
        'investor-relations',
        'why-sanaa',
        'blog.index',
        'blog.show',
        'blog.author',
        'blog.category',
        'blog.tag',
        'blog.feed',
        'blog.feed.json',
        'policies',
        'policies.privacy-notice',
        'policies.terms-conditions',
        'policies.security',
        'developer-platforms',
        'finance.index',
        'finance.pricing',
        'finance.cards',
        'finance.team',
        'finance.technologies',
        'sitemap',
        'sitemap.pages',
        'sitemap.blogs',
        'sitemap.finance',
    ];

    /**
     * Cache durations in seconds for different route types
     */
    private const CACHE_DURATIONS = [
        'blog.feed' => 300,        // 5 minutes for feeds
        'blog.feed.json' => 300,
        'sitemap' => 3600,         // 1 hour for sitemaps
        'sitemap.pages' => 3600,
        'sitemap.blogs' => 3600,
        'sitemap.finance' => 3600,
        'blog.index' => 600,       // 10 minutes for blog index
        'home' => 300,             // 5 minutes for homepage
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Skip cache headers for authenticated users
        if (auth()->check()) {
            return $response;
        }

        $routeName = $request->route()?->getName();

        // Check if this is a public route that should be cached
        if ($this->shouldCache($routeName)) {
            $maxAge = $this->getCacheDuration($routeName);
            
            // Set cache headers for CDN/browser caching
            $response->headers->set('Cache-Control', sprintf(
                'public, max-age=%d, s-maxage=%d',
                $maxAge,
                $maxAge * 2 // Allow CDNs to cache longer
            ));
            
            // Add stale-while-revalidate for better performance
            $response->headers->set('CDN-Cache-Control', sprintf(
                'public, max-age=%d, stale-while-revalidate=60',
                $maxAge * 2
            ));
            
            // Add Vary header for proper cache segmentation
            $response->headers->set('Vary', 'Accept-Encoding, Accept-Language');
        }

        return $response;
    }

    /**
     * Check if the current route should have cache headers
     */
    private function shouldCache(?string $routeName): bool
    {
        if (!$routeName) {
            return false;
        }

        // Check exact matches
        if (in_array($routeName, self::PUBLIC_ROUTES, true)) {
            return true;
        }

        // Check prefix matches for blog posts and dynamic pages
        $cacheablePrefixes = ['blog.show', 'page.show', 'finance.show'];
        foreach ($cacheablePrefixes as $prefix) {
            if (str_starts_with($routeName, $prefix)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get cache duration for a specific route
     */
    private function getCacheDuration(?string $routeName): int
    {
        if (!$routeName) {
            return 300; // Default 5 minutes
        }

        return self::CACHE_DURATIONS[$routeName] ?? 300;
    }
}
