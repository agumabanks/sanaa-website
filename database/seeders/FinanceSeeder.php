<?php

namespace Database\Seeders;

use App\Models\FinancePage;
use App\Models\FinancePricingPlan;
use Illuminate\Database\Seeder;

class FinanceSeeder extends Seeder
{
    public function run(): void
    {
        // Pricing plans
        if (FinancePricingPlan::count() === 0) {
            FinancePricingPlan::create([
                'name' => 'Starter',
                'summary' => 'For pilots and small teams',
                'monthly_price' => 99,
                'annual_price' => 999,
                'features' => ['Core APIs', 'Basic reporting'],
                'limits' => ['Up to 10k txns/mo'],
                'badge' => 'Popular',
                'sort_order' => 1,
                'is_active' => true,
            ]);
        }

        // Overview page
        FinancePage::firstOrCreate(['slug' => 'overview'], [
            'title' => 'Overview',
            'content' => ['blocks' => [
                ['type' => 'richtext', 'html' => '<p>Welcome to Sanaa Finance.</p>'],
            ]],
            'status' => 'published',
            'seo_title' => 'Sanaa Finance Overview',
            'meta_description' => 'Modern banking & payments infrastructure.',
        ]);
    }
}

