<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingPricingPlan extends Model
{
    protected $fillable = [
        'name',
        'badge',
        'price',
        'currency',
        'billing_period',
        'description',
        'features',
        'cta_text',
        'cta_link',
        'is_featured',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'features' => 'array',
        'price' => 'decimal:2',
        'is_featured' => 'boolean',
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

    public function getFormattedPriceAttribute(): string
    {
        if ($this->price == 0) {
            return $this->currency . ' 0';
        }
        return $this->currency . ' ' . number_format($this->price, 0, '.', ',');
    }
}
