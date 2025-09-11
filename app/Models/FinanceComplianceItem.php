<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinanceComplianceItem extends Model
{
    protected $fillable = [
        'standard',
        'status',
        'evidence_file',
        'evidence_link',
        'last_updated',
        'is_active',
    ];

    protected $casts = [
        'last_updated' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
