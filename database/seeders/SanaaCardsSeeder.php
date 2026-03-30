<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LoyaltyProgram;
use App\Models\LoyaltyTier;
use App\Models\RewardRule;
use App\Models\ReferralProgram;
use App\Models\Service;

class SanaaCardsSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Add to Services
        Service::updateOrCreate(
            ['name' => 'Sanaa Cards & Loyalty'],
            [
                'description' => 'A complete loyalty management platform to retain customers, reward loyalty, and increase lifetime value. Acquire, engage, and grow your customer base.',
                'icon' => 'fas fa-id-card',
                'active' => true,
                'price' => 0.00
            ]
        );

        // 2. Sample Loyalty Programs
        $program = LoyaltyProgram::create([
            'name' => 'Sanaa Rewards+ for Retail',
            'slug' => 'sanaa-rewards-plus-retail',
            'description' => 'A comprehensive reward system for retail businesses in Uganda.',
            'industry' => 'Retail',
            'settings' => [
                'points_name' => 'Sanaa Points',
                'widget_color' => '#10b981',
                'currency' => 'UGX'
            ]
        ]);

        // 3. Loyalty Tiers
        LoyaltyTier::create([
            'loyalty_program_id' => $program->id,
            'name' => 'Bronze',
            'min_points' => 0,
            'multiplier' => 1.0,
            'perks' => ['Standard rewards', 'Birthday points']
        ]);

        LoyaltyTier::create([
            'loyalty_program_id' => $program->id,
            'name' => 'Silver',
            'min_points' => 5000,
            'multiplier' => 1.2,
            'perks' => ['Priority support', 'Exclusive discounts', '1.2x points on weekends']
        ]);

        LoyaltyTier::create([
            'loyalty_program_id' => $program->id,
            'name' => 'Gold',
            'min_points' => 20000,
            'multiplier' => 1.5,
            'perks' => ['Early access to sales', 'Free delivery', 'Dedicated account manager', '1.5x points always']
        ]);

        // 4. Reward Rules
        RewardRule::create([
            'loyalty_program_id' => $program->id,
            'event_type' => 'Purchase',
            'points_awarded' => 1,
            'min_spend' => 1000.00, // 1 point per 1000 UGX
        ]);

        RewardRule::create([
            'loyalty_program_id' => $program->id,
            'event_type' => 'Review',
            'points_awarded' => 50,
        ]);

        RewardRule::create([
            'loyalty_program_id' => $program->id,
            'event_type' => 'Newsletter Signup',
            'points_awarded' => 100,
        ]);

        // 5. Referral Program
        ReferralProgram::create([
            'loyalty_program_id' => $program->id,
            'referrer_points' => 200,
            'referee_points' => 100,
            'referee_discount' => 10.00, // 10% off
        ]);
    }
}
