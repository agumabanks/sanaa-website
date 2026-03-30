<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageView extends Model
{
    protected $fillable = [
        'page_url',
        'page_title',
        'route_name',
        'ip_address',
        'user_agent',
        'referrer',
        'user_id',
        'session_id',
        'device_type',
        'browser',
        'country',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user who viewed the page (if logged in)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope to filter by date range
     */
    public function scopeDateRange($query, $start, $end)
    {
        return $query->whereBetween('created_at', [$start, $end]);
    }

    /**
     * Scope to get top pages by view count
     */
    public function scopeTopPages($query, $limit = 10)
    {
        return $query->select('page_url', 'page_title', 'route_name')
            ->selectRaw('COUNT(*) as views')
            ->selectRaw('COUNT(DISTINCT ip_address) as unique_views')
            ->groupBy('page_url', 'page_title', 'route_name')
            ->orderByDesc('views')
            ->limit($limit);
    }

    /**
     * Scope for today's views
     */
    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    /**
     * Scope for this week's views
     */
    public function scopeThisWeek($query)
    {
        return $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
    }

    /**
     * Scope for this month's views
     */
    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year);
    }

    /**
     * Get daily view counts for charts
     */
    public static function getDailyStats($days = 30)
    {
        return static::selectRaw('DATE(created_at) as date')
            ->selectRaw('COUNT(*) as views')
            ->selectRaw('COUNT(DISTINCT ip_address) as unique_views')
            ->where('created_at', '>=', now()->subDays($days))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }
}
