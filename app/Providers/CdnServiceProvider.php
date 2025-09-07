<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class CdnServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('cdn', function ($app) {
            return new CdnManager();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Add CDN helper to Blade templates
        \Blade::directive('cdn', function ($expression) {
            return "<?php echo \\cdn_asset({$expression}); ?>";
        });
    }
}

class CdnManager
{
    protected $cdnUrl;
    protected $enabled;

    public function __construct()
    {
        $this->cdnUrl = config('blog.performance.cdn_url', env('CDN_URL'));
        $this->enabled = !empty($this->cdnUrl) && config('blog.performance.cdn_enabled', true);
    }

    /**
     * Get CDN URL for asset
     */
    public function asset($path)
    {
        if (!$this->enabled || $this->isLocalAsset($path)) {
            return asset($path);
        }

        // Remove leading slash if present
        $path = ltrim($path, '/');

        // Ensure proper CDN URL formatting
        $cdnUrl = rtrim($this->cdnUrl, '/');

        return $cdnUrl . '/' . $path;
    }

    /**
     * Check if asset should be served locally
     */
    protected function isLocalAsset($path)
    {
        // Always serve admin assets locally
        if (str_contains($path, 'admin')) {
            return true;
        }

        // Serve manifest and service worker locally
        if (in_array(basename($path), ['manifest.json', 'sw.js', 'robots.txt'])) {
            return true;
        }

        return false;
    }

    /**
     * Get CDN URL for storage assets
     */
    public function storage($path)
    {
        if (!$this->enabled) {
            return asset('storage/' . $path);
        }

        $cdnUrl = rtrim($this->cdnUrl, '/');
        $path = ltrim($path, '/');

        return $cdnUrl . '/storage/' . $path;
    }

    /**
     * Check if CDN is enabled
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * Get CDN URL
     */
    public function getUrl()
    {
        return $this->cdnUrl;
    }
}
