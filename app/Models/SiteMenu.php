<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class SiteMenu extends Model
{
    protected $fillable = [
        'location',
        'label',
        'url',
        'route_name',
        'parent_id',
        'sort_order',
        'is_external',
        'is_active',
        'icon',
        'description',
        'badge',
        'badge_color',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_external' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get child menu items
     */
    public function children(): HasMany
    {
        return $this->hasMany(SiteMenu::class, 'parent_id')
            ->where('is_active', true)
            ->orderBy('sort_order');
    }

    /**
     * Get parent menu item
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(SiteMenu::class, 'parent_id');
    }

    /**
     * Get the resolved URL (from route_name or url)
     */
    public function getResolvedUrlAttribute(): string
    {
        if ($this->route_name) {
            try {
                return route($this->route_name);
            } catch (\Exception $e) {
                return '#';
            }
        }
        return $this->url ?? '#';
    }

    /**
     * Scope to get only active items
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get only top-level items (no parent)
     */
    public function scopeTopLevel($query)
    {
        return $query->whereNull('parent_id');
    }

    /**
     * Scope to filter by location
     */
    public function scopeLocation($query, string $location)
    {
        return $query->where('location', $location);
    }

    /**
     * Get menu items for a specific location with caching
     */
    public static function getMenuItems(string $location): \Illuminate\Database\Eloquent\Collection
    {
        $cacheKey = "site_menu_{$location}";
        
        return Cache::remember($cacheKey, 3600, function () use ($location) {
            return static::query()
                ->location($location)
                ->active()
                ->topLevel()
                ->orderBy('sort_order')
                ->with(['children' => function ($query) {
                    $query->active()->orderBy('sort_order')->with('children');
                }])
                ->get();
        });
    }

    /**
     * Clear menu cache when updated
     */
    protected static function booted(): void
    {
        static::saved(function ($menu) {
            Cache::forget("site_menu_{$menu->location}");
            Cache::forget('site_menu_main');
            Cache::forget('site_menu_footer');
        });

        static::deleted(function ($menu) {
            Cache::forget("site_menu_{$menu->location}");
            Cache::forget('site_menu_main');
            Cache::forget('site_menu_footer');
        });
    }
}
