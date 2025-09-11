<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinancePage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'status',
        'scheduled_at',
        'seo_title',
        'meta_description',
        'canonical_url',
        'og_image',
        'schema_type',
        'is_indexed',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'content' => 'array',
        'scheduled_at' => 'datetime',
        'is_indexed' => 'boolean',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Scope for published pages
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->where(function ($q) {
                         $q->whereNull('scheduled_at')
                           ->orWhere('scheduled_at', '<=', now());
                     });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
