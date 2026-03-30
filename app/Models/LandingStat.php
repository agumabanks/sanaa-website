<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingStat extends Model
{
    protected $fillable = [
        'value',
        'label',
        'section',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function scopeSection($query, string $section)
    {
        return $query->where('section', $section);
    }
}
