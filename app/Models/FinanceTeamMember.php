<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinanceTeamMember extends Model
{
    protected $table = 'finance_team';

    protected $fillable = [
        'name',
        'role',
        'headshot',
        'bio',
        'socials',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'socials' => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
