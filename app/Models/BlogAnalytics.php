<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogAnalytics extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_id',
        'ip_address',
        'user_agent',
        'referrer',
        'event_type',
        'metadata',
        'value'
    ];

    protected $casts = [
        'metadata' => 'array',
        'value' => 'integer'
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    // Scope for different event types
    public function scopePageViews($query)
    {
        return $query->where('event_type', 'page_view');
    }

    public function scopeLikes($query)
    {
        return $query->where('event_type', 'like');
    }

    public function scopeShares($query)
    {
        return $query->where('event_type', 'share');
    }

    public function scopeBookmarks($query)
    {
        return $query->where('event_type', 'bookmark');
    }

    public function scopeScrollDepth($query)
    {
        return $query->where('event_type', 'scroll_depth');
    }

    public function scopeReadingTime($query)
    {
        return $query->where('event_type', 'reading_time');
    }
}