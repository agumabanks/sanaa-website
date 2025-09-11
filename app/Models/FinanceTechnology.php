<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinanceTechnology extends Model
{
    protected $fillable = [
        'name',
        'logo',
        'description',
        'link',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
