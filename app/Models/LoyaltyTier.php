<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoyaltyTier extends Model
{
    use HasFactory;

    protected $fillable = ['loyalty_program_id', 'name', 'min_points', 'multiplier', 'perks'];

    protected $casts = [
        'perks' => 'array',
        'multiplier' => 'decimal:2',
    ];

    public function program()
    {
        return $this->belongsTo(LoyaltyProgram::class, 'loyalty_program_id');
    }
}
