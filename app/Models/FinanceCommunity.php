<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinanceCommunity extends Model
{
    protected $fillable = [
        'segment_name',
        'needs',
        'value_props',
        'case_links',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'needs' => 'array',
        'value_props' => 'array',
        'case_links' => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
