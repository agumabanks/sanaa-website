<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardRule extends Model
{
    use HasFactory;

    protected $fillable = ['loyalty_program_id', 'event_type', 'points_awarded', 'min_spend', 'active'];

    protected $casts = [
        'active' => 'boolean',
        'min_spend' => 'decimal:2',
    ];

    public function program()
    {
        return $this->belongsTo(LoyaltyProgram::class, 'loyalty_program_id');
    }
}
