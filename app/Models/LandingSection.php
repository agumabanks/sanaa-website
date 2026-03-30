<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LandingSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'section_type',
        'content',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'content' => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }

    /**
     * Get translatable content for a specific key and locale
     */
    public function getTranslation($key, $locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return data_get($this->content, "{$locale}.{$key}") 
            ?? data_get($this->content, "en.{$key}") 
            ?? data_get($this->content, "{$key}");
    }
}
