<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralProgram extends Model
{
    use HasFactory;

    protected $fillable = ['loyalty_program_id', 'referrer_points', 'referee_points', 'referee_discount', 'active'];

    protected $casts = [
        'active' => 'boolean',
        'referee_discount' => 'decimal:2',
    ];

    public function program()
    {
        return $this->belongsTo(LoyaltyProgram::class, 'loyalty_program_id');
    }
}
