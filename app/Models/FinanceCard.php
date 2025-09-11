<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinanceCard extends Model
{
    protected $fillable = [
        'name',
        'image',
        'fees',
        'features',
        'eligibility',
        'faq',
        'tnc_file',
        'status',
    ];

    protected $casts = [
        'fees' => 'array',
        'features' => 'array',
        'faq' => 'array',
    ];

    // Scope for published cards
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
