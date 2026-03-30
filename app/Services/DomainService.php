<?php

namespace App\Services;

use App\Models\DomainSetting;
use Illuminate\Support\Facades\Cache;

class DomainService
{
    /**
     * Get the active domain for a given key
     */
    public static function getDomain(string $key): ?string
    {
        return Cache::remember("domain_{$key}", 3600, function () use ($key) {
            return DomainSetting::getActiveDomain($key);
        });
    }

    /**
     * Get all active domains
     */
    public static function getAllDomains(): array
    {
        return Cache::remember('all_domains', 3600, function () {
            return DomainSetting::where('is_active', true)
                ->pluck('domain', 'key')
                ->toArray();
        });
    }

    /**
     * Update a domain setting
     */
    public static function updateDomain(string $key, string $domain, int $userId = null): bool
    {
        $setting = DomainSetting::updateOrCreate(
            ['key' => $key],
            [
                'domain' => $domain,
                'is_active' => true,
                'last_updated_by' => $userId,
            ]
        );

        // Clear cache
        Cache::forget("domain_{$key}");
        Cache::forget('all_domains');

        return $setting->wasRecentlyCreated || $setting->wasChanged();
    }

    /**
     * Get Soko domain (main use case)
     */
    public static function getSokoDomain(): string
    {
        return self::getDomain('soko_domain') ?? 'soko.sanaa.ug';
    }

    /**
     * Get Media domain
     */
    public static function getMediaDomain(): string
    {
        return self::getDomain('media_domain') ?? 'media.sanaa.co';
    }

    /**
     * Get Status domain
     */
    public static function getStatusDomain(): string
    {
        return self::getDomain('status_domain') ?? 'status.sanaa.co';
    }

    /**
     * Get Finance domain
     */
    public static function getFinanceDomain(): string
    {
        return self::getDomain('finance_domain') ?? 'fin.sanaa.co';
    }
}
