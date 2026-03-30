<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoyaltyProgram extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'industry', 'active', 'settings'];

    protected $casts = [
        'active' => 'boolean',
        'settings' => 'array',
    ];

    public function tiers()
    {
        return $this->hasMany(LoyaltyTier::class);
    }

    public function rewardRules()
    {
        return $this->hasMany(RewardRule::class);
    }

    public function referralProgram()
    {
        return $this->hasOne(ReferralProgram::class);
    }
}
