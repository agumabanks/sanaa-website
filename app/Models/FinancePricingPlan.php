<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancePricingPlan extends Model
{
    protected $fillable = [
        'name',
        'summary',
        'monthly_price',
        'annual_price',
        'features',
        'limits',
        'cta_link',
        'badge',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'features' => 'array',
        'limits' => 'array',
        'monthly_price' => 'decimal:2',
        'annual_price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // Scope for active plans
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
