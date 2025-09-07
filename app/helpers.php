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