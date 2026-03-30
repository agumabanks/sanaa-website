<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LandingPageSetting;
use App\Models\IndustrySolution;
use App\Models\Capability;
use App\Models\LandingPricingPlan;
use App\Models\LandingStat;

class LandingPageSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedSettings();
        $this->seedIndustries();
        $this->seedCapabilities();
        $this->seedPricingPlans();
        $this->seedStats();
    }

    private function seedSettings(): void
    {
        $settings = [
            ['key' => 'hero_eyebrow', 'value' => 'Digital infrastructure for Africa', 'type' => 'text'],
            ['key' => 'hero_title', 'value' => 'Building the future we want', 'type' => 'text'],
            ['key' => 'hero_cta_primary_text', 'value' => 'Explore Sanaa', 'type' => 'text'],
            ['key' => 'hero_cta_primary_link', 'value' => '#services', 'type' => 'text'],
            ['key' => 'hero_cta_secondary_text', 'value' => 'Shop on Soko 24', 'type' => 'text'],
            ['key' => 'hero_cta_secondary_link', 'value' => 'https://soko.sanaa.co', 'type' => 'text'],
            ['key' => 'mission_text', 'value' => 'Our mission is to empower businesses with modern digital infrastructure for payments, media and commerce.', 'type' => 'text'],
            ['key' => 'mission_insight', 'value' => 'We unify the rails for commerce in Africa one platform for selling, fulfilling, funding, and storytelling, so every ambitious founder can scale faster.', 'type' => 'text'],
            ['key' => 'join_eyebrow', 'value' => 'Unified commerce', 'type' => 'text'],
            ['key' => 'join_title', 'value' => 'Join the <span>400+ businesses</span> running confidently with <span>Sanaa</span>', 'type' => 'html'],
            ['key' => 'join_subtitle', 'value' => 'From pop-up shops to multi-location enterprises, Sanaa unifies payments, inventory, and customer experience so you can focus on growth.', 'type' => 'text'],
            ['key' => 'join_meta_1', 'value' => '24h onboarding concierge', 'type' => 'text'],
            ['key' => 'join_meta_2', 'value' => '98% customer satisfaction', 'type' => 'text'],
            ['key' => 'join_footnote', 'value' => '*Source: Q1 2023 Earnings Report', 'type' => 'text'],
            ['key' => 'join_trust_text', 'value' => 'Trusted by teams in retail, F&B, beauty, and professional services', 'type' => 'text'],
            ['key' => 'contact_phone_support', 'value' => '0706 27-2481', 'type' => 'text'],
            ['key' => 'contact_phone_sales', 'value' => '0200 90-3222', 'type' => 'text'],
        ];

        foreach ($settings as $setting) {
            LandingPageSetting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value'], 'type' => $setting['type']]
            );
        }
    }

    private function seedIndustries(): void
    {
        IndustrySolution::truncate();

        $industries = [
            [
                'title' => 'Food & Beverage',
                'subtitle' => 'Quick service, full service, bars',
                'icon' => 'utensils',
                'image' => null,
                'link' => '/services',
                'sort_order' => 1,
            ],
            [
                'title' => 'Retail',
                'subtitle' => 'In-store & online commerce',
                'icon' => 'shopping-bag',
                'image' => null,
                'link' => '/services',
                'sort_order' => 2,
            ],
            [
                'title' => 'Beauty',
                'subtitle' => 'Salons, barbers & spas',
                'icon' => 'scissors',
                'image' => null,
                'link' => '/services',
                'sort_order' => 3,
            ],
            [
                'title' => 'Services',
                'subtitle' => 'Invoicing, bookings & billing',
                'icon' => 'briefcase',
                'image' => null,
                'link' => '/services',
                'sort_order' => 4,
            ],
        ];

        foreach ($industries as $industry) {
            IndustrySolution::create($industry);
        }
    }

    private function seedCapabilities(): void
    {
        Capability::truncate();

        $capabilities = [
            [
                'title' => 'Take payments',
                'description' => 'Sell anywhere with POS & online checkout.',
                'icon' => 'credit-card',
                'link' => '/services',
                'sort_order' => 1,
            ],
            [
                'title' => 'Manage your team',
                'description' => 'Payroll, shifts, and permissions.',
                'icon' => 'users',
                'link' => '/services',
                'sort_order' => 2,
            ],
            [
                'title' => 'Grow customers',
                'description' => 'Marketing automation & loyalty.',
                'icon' => 'trending-up',
                'link' => '/services',
                'sort_order' => 3,
            ],
            [
                'title' => 'Control cash flow',
                'description' => 'Faster access to funds & insights.',
                'icon' => 'dollar-sign',
                'link' => 'https://sanaa.ug/finance',
                'sort_order' => 4,
            ],
            [
                'title' => 'Connect your apps',
                'description' => 'Integrate tools to streamline work.',
                'icon' => 'link',
                'link' => '/developer-platforms',
                'sort_order' => 5,
            ],
        ];

        foreach ($capabilities as $capability) {
            Capability::create($capability);
        }
    }

    private function seedPricingPlans(): void
    {
        LandingPricingPlan::truncate();

        $plans = [
            [
                'name' => 'Free',
                'badge' => 'Free',
                'price' => 0,
                'currency' => 'UGX',
                'billing_period' => 'month',
                'description' => 'Essentials to get started.',
                'features' => [
                    'Basic POS & online catalog',
                    'Accept payments',
                    'Core analytics',
                ],
                'cta_text' => 'Get started',
                'cta_link' => '/register',
                'is_featured' => false,
                'sort_order' => 1,
            ],
            [
                'name' => 'Plus',
                'badge' => 'Plus',
                'price' => 49000,
                'currency' => 'UGX',
                'billing_period' => 'month',
                'description' => 'Best value for growing teams.',
                'features' => [
                    'Advanced POS & staff roles',
                    'Loyalty & marketing tools',
                    'Priority support',
                ],
                'cta_text' => 'Try free for 30 days',
                'cta_link' => '/prices',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Premium',
                'badge' => 'Premium',
                'price' => 149000,
                'currency' => 'UGX',
                'billing_period' => 'month',
                'description' => 'Everything, plus premium support.',
                'features' => [
                    'Multi-location & APIs',
                    'Advanced analytics & exports',
                    '24/7 priority support',
                ],
                'cta_text' => 'Contact sales',
                'cta_link' => '/contact',
                'is_featured' => false,
                'sort_order' => 3,
            ],
        ];

        foreach ($plans as $plan) {
            LandingPricingPlan::create($plan);
        }
    }

    private function seedStats(): void
    {
        LandingStat::truncate();

        $stats = [
            [
                'value' => '45%',
                'label' => 'Average revenue lift after switching',
                'section' => 'join',
                'sort_order' => 1,
            ],
            [
                'value' => '3x',
                'label' => 'Faster settlement across locations',
                'section' => 'join',
                'sort_order' => 2,
            ],
            [
                'value' => '92%',
                'label' => 'Automation rate on repeat workflows',
                'section' => 'join',
                'sort_order' => 3,
            ],
        ];

        foreach ($stats as $stat) {
            LandingStat::create($stat);
        }
    }
}
