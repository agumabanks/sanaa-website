<?php

namespace Database\Seeders;

use App\Models\SanaaCardsPageSetting;
use Illuminate\Database\Seeder;

class SanaaCardsPageSettingsSeeder extends Seeder
{
    public function run()
    {
        // =================================================================
        // HERO SECTION
        // =================================================================
        SanaaCardsPageSetting::set('hero_badge', 'Uganda\'s Complete Loyalty Platform', 'text');
        SanaaCardsPageSetting::set('hero_title', 'Transform Customers Into<br><span class="text-gradient-emerald">Loyal Members</span>', 'text');
        SanaaCardsPageSetting::set('hero_description', 'Issue branded loyalty cards, automate rewards, and grow repeat business. Trusted by 50+ businesses across Uganda generating UGX 2.5B+ in member transactions.', 'textarea');
        SanaaCardsPageSetting::set('hero_cta_primary', 'Start Free Trial', 'text');
        SanaaCardsPageSetting::set('hero_cta_secondary', 'Book a Demo', 'text');
        SanaaCardsPageSetting::set('hero_visual', asset('storage/sanaa-cards/dashboard.png'), 'image');
        SanaaCardsPageSetting::set('card_visual', asset('storage/sanaa-cards/card.png'), 'image');

        // =================================================================
        // STATS SECTION (in UGX)
        // =================================================================
        $stats = [
            ['value' => '50K+', 'label' => 'Active Members', 'description' => 'Cardholders managed'],
            ['value' => '2.5B+', 'label' => 'UGX Transactions', 'description' => 'Processed monthly'],
            ['value' => '85%', 'label' => 'Retention Rate', 'description' => 'Average across clients'],
            ['value' => '500+', 'label' => 'Cards Issued Daily', 'description' => 'And growing'],
        ];
        SanaaCardsPageSetting::set('stats', $stats, 'json');

        // =================================================================
        // PLATFORM FEATURES
        // =================================================================
        SanaaCardsPageSetting::set('features_title', 'Everything You Need to Run a Membership Business', 'text');
        SanaaCardsPageSetting::set('features_subtitle', 'A complete operating system for customer loyalty and retention.', 'textarea');
        
        $features = [
            [
                'icon' => 'card',
                'title' => 'Branded Loyalty Cards',
                'description' => 'Issue custom physical NFC cards or digital wallet passes with your brand identity. Starting from UGX 5,000 per card.'
            ],
            [
                'icon' => 'reward',
                'title' => 'Points & Rewards Engine',
                'description' => 'Automated point accumulation on every transaction. Set redemption rules, bonus multipliers, and expiry dates.'
            ],
            [
                'icon' => 'users',
                'title' => 'Member CRM Database',
                'description' => 'Centralized customer profiles with purchase history, preferences, and contact details for targeted marketing.'
            ],
            [
                'icon' => 'chart',
                'title' => 'Analytics Dashboard',
                'description' => 'Real-time insights on retention, churn, lifetime value (LTV), and revenue per member.'
            ],
            [
                'icon' => 'mobile',
                'title' => 'Mobile App Integration',
                'description' => 'Members check balances, view rewards, and receive notifications via the Sanaa mobile app.'
            ],
            [
                'icon' => 'pos',
                'title' => 'POS Integration',
                'description' => 'Works with existing point-of-sale systems. Card tap, scan, or manual entry at checkout.'
            ],
            [
                'icon' => 'tier',
                'title' => 'VIP Tier System',
                'description' => 'Create Bronze, Silver, Gold, Platinum tiers with escalating benefits and exclusive perks.'
            ],
            [
                'icon' => 'sms',
                'title' => 'SMS & Email Campaigns',
                'description' => 'Send targeted promotions, birthday rewards, and win-back campaigns to segmented members.'
            ],
        ];
        SanaaCardsPageSetting::set('features_grid', $features, 'json');

        // =================================================================
        // INDUSTRIES SERVED
        // =================================================================
        $industries = [
            [
                'category' => 'Financial Services',
                'icon' => 'bank',
                'businesses' => [
                    'SACCOs (Savings & Credit Cooperatives)',
                    'Microfinance Institutions',
                    'Money Lenders',
                    'Investment Clubs',
                    'Credit Unions',
                    'Insurance Agents',
                ],
                'use_case' => 'Member identification, loan tracking, savings rewards, and dividend management.',
                'example_reward' => 'Earn 1 point per UGX 10,000 saved. Redeem for loan interest discounts.'
            ],
            [
                'category' => 'Restaurants & Food Service',
                'icon' => 'restaurant',
                'businesses' => [
                    'Restaurants & Cafes',
                    'Fast Food Chains',
                    'Coffee Shops',
                    'Food Courts',
                    'Catering Services',
                    'Bakeries & Pastry Shops',
                ],
                'use_case' => 'Stamp cards, spend-based rewards, and frequent diner programs.',
                'example_reward' => 'Earn 1 point per UGX 5,000 spent. 100 points = Free meal up to UGX 25,000.'
            ],
            [
                'category' => 'Hotels & Hospitality',
                'icon' => 'hotel',
                'businesses' => [
                    'Hotels & Lodges',
                    'Guest Houses',
                    'Resorts & Spas',
                    'Airbnb Hosts',
                    'Conference Centers',
                    'Travel Agencies',
                ],
                'use_case' => 'Room upgrades, loyalty nights, and referral bonuses for returning guests.',
                'example_reward' => 'Stay 5 nights, get 1 free. VIP members get complimentary breakfast.'
            ],
            [
                'category' => 'Entertainment & Nightlife',
                'icon' => 'entertainment',
                'businesses' => [
                    'Nightclubs & Bars',
                    'Casinos',
                    'Cinemas & Theaters',
                    'Event Venues',
                    'Lounges',
                    'Gaming Arcades',
                ],
                'use_case' => 'VIP access, table reservations, and exclusive member-only events.',
                'example_reward' => 'Gold members skip queues. Spend UGX 500,000/month = Platinum status.'
            ],
            [
                'category' => 'Retail & Shopping',
                'icon' => 'retail',
                'businesses' => [
                    'Supermarkets',
                    'Clothing Boutiques',
                    'Electronics Stores',
                    'Pharmacies',
                    'Hardware Stores',
                    'Phone & Accessories Shops',
                ],
                'use_case' => 'Points-per-shilling programs, cashback rewards, and exclusive discounts.',
                'example_reward' => 'Earn 1 point per UGX 1,000. 1,000 points = UGX 5,000 voucher.'
            ],
            [
                'category' => 'Health & Fitness',
                'icon' => 'fitness',
                'businesses' => [
                    'Gyms & Fitness Centers',
                    'Yoga Studios',
                    'Swimming Pools',
                    'Sports Clubs',
                    'Personal Trainers',
                    'Wellness Centers',
                ],
                'use_case' => 'Membership cards, class credits, and attendance-based rewards.',
                'example_reward' => 'Check in 20 times/month = Free personal training session.'
            ],
            [
                'category' => 'Beauty & Personal Care',
                'icon' => 'beauty',
                'businesses' => [
                    'Hair Salons',
                    'Barbershops',
                    'Spas & Massage Parlors',
                    'Nail Studios',
                    'Beauty Supply Stores',
                    'Cosmetic Clinics',
                ],
                'use_case' => 'Service stamps, referral rewards, and birthday specials.',
                'example_reward' => '5 haircuts = 1 free. Refer a friend = UGX 10,000 credit.'
            ],
            [
                'category' => 'Professional Services',
                'icon' => 'professional',
                'businesses' => [
                    'Law Firms',
                    'Accounting Firms',
                    'Consulting Agencies',
                    'Real Estate Agencies',
                    'Medical Clinics',
                    'Dental Practices',
                ],
                'use_case' => 'Client appreciation programs, retainer rewards, and referral incentives.',
                'example_reward' => 'Loyal clients get priority scheduling and annual appreciation gifts.'
            ],
            [
                'category' => 'Education & Training',
                'icon' => 'education',
                'businesses' => [
                    'Private Schools',
                    'Driving Schools',
                    'Language Centers',
                    'Vocational Institutes',
                    'Tutoring Centers',
                    'Computer Training Labs',
                ],
                'use_case' => 'Student ID cards, course completion rewards, and alumni networks.',
                'example_reward' => 'Complete 3 courses = 10% off next enrollment. Refer = UGX 50,000 credit.'
            ],
            [
                'category' => 'Automotive',
                'icon' => 'automotive',
                'businesses' => [
                    'Car Washes',
                    'Auto Repair Garages',
                    'Fuel Stations',
                    'Car Dealerships',
                    'Spare Parts Shops',
                    'Motorcycle Dealers',
                ],
                'use_case' => 'Service stamps, fuel rewards, and maintenance reminder programs.',
                'example_reward' => '10 washes = 1 free. Fuel loyalty: 1 point per liter.'
            ],
        ];
        SanaaCardsPageSetting::set('industries', $industries, 'json');

        // =================================================================
        // LIFECYCLE FLOW
        // =================================================================
        $lifecycle = [
            [
                'phase' => 'Step 1',
                'title' => 'Issue Branded Cards',
                'description' => 'Design and issue custom loyalty cards with your logo, colors, and brand. Choose physical NFC cards from UGX 5,000 each or digital wallet passes. Capture customer data at the point of sale.',
                'image_type' => 'card_mockup'
            ],
            [
                'phase' => 'Step 2',
                'title' => 'Earn & Track Points',
                'description' => 'Members earn points on every purchase. Set custom rules: 1 point per UGX 1,000 spent, bonus points on specific items, or double points on slow days. Track everything in real-time.',
                'image_type' => 'rewards_ui'
            ],
            [
                'phase' => 'Step 3',
                'title' => 'Redeem & Retain',
                'description' => 'Members redeem points for discounts, free products, or exclusive experiences. VIP tiers unlock premium benefits. Watch retention soar as customers choose you over competitors.',
                'image_type' => 'vip_card'
            ]
        ];
        SanaaCardsPageSetting::set('lifecycle_flow', $lifecycle, 'json');

        // =================================================================
        // PRICING (in UGX)
        // =================================================================
        $pricing = [
            'card_physical' => [
                'name' => 'Physical NFC Card',
                'price' => 5000,
                'currency' => 'UGX',
                'per' => 'card',
                'min_order' => 100,
            ],
            'card_digital' => [
                'name' => 'Digital Wallet Pass',
                'price' => 2000,
                'currency' => 'UGX',
                'per' => 'card',
                'min_order' => 50,
            ],
            'platform_starter' => [
                'name' => 'Starter Plan',
                'price' => 150000,
                'currency' => 'UGX',
                'per' => 'month',
                'members' => 500,
                'features' => ['Basic CRM', 'Points tracking', 'SMS notifications', 'Email support'],
            ],
            'platform_growth' => [
                'name' => 'Growth Plan',
                'price' => 350000,
                'currency' => 'UGX',
                'per' => 'month',
                'members' => 2000,
                'features' => ['Full CRM', 'VIP tiers', 'Analytics dashboard', 'API access', 'Priority support'],
            ],
            'platform_enterprise' => [
                'name' => 'Enterprise',
                'price' => 0,
                'currency' => 'UGX',
                'per' => 'month',
                'members' => 'Unlimited',
                'features' => ['White-label solution', 'Dedicated account manager', 'Custom integrations', 'On-site training'],
                'custom_pricing' => true,
            ],
        ];
        SanaaCardsPageSetting::set('pricing', $pricing, 'json');

        // =================================================================
        // CUSTOMER TESTIMONIALS
        // =================================================================
        $testimonials = [
            [
                'name' => 'James Mukasa',
                'role' => 'Managing Director',
                'company' => 'Cafe Javas Uganda',
                'location' => 'Kampala',
                'industry' => 'Restaurant',
                'quote' => 'Sanaa Cards transformed our customer retention. We\'ve seen a 40% increase in repeat visits since launching our loyalty program. The system pays for itself.',
                'avatar' => 'JM',
                'rating' => 5,
                'stats' => ['40% more repeat customers', 'UGX 45M additional revenue/month'],
            ],
            [
                'name' => 'Grace Nakamya',
                'role' => 'CEO',
                'company' => 'Tropical Supermarket',
                'location' => 'Entebbe',
                'industry' => 'Retail',
                'quote' => 'Our customers love earning points on every purchase. The mobile app notifications bring them back for double-point days. Easy to use and our staff picked it up quickly.',
                'avatar' => 'GN',
                'rating' => 5,
                'stats' => ['12,000 active members', '85% retention rate'],
            ],
            [
                'name' => 'Samuel Okiror',
                'role' => 'General Manager',
                'company' => 'Kabira Country Club',
                'location' => 'Kampala',
                'industry' => 'Entertainment',
                'quote' => 'The VIP tier system is a game-changer. Our platinum members spend 3x more than regular visitors. Sanaa Cards helped us identify and reward our best customers.',
                'avatar' => 'SO',
                'rating' => 5,
                'stats' => ['3x higher VIP spend', 'UGX 120M member transactions/month'],
            ],
            [
                'name' => 'Patricia Amongi',
                'role' => 'Chairperson',
                'company' => 'Jinja United SACCO',
                'location' => 'Jinja',
                'industry' => 'Financial Services',
                'quote' => 'Every member now has a branded SACCO card for identification and transactions. Tracking savings and loan eligibility is seamless. Highly recommend for any SACCO.',
                'avatar' => 'PA',
                'rating' => 5,
                'stats' => ['5,000 SACCO members', '98% card activation rate'],
            ],
            [
                'name' => 'David Ssebunya',
                'role' => 'Owner',
                'company' => 'Sparkle Auto Wash',
                'location' => 'Kampala',
                'industry' => 'Automotive',
                'quote' => 'Simple stamp card system digitized. Customers earn a free wash after 10 visits. No more lost paper cards. Our repeat business doubled in 3 months.',
                'avatar' => 'DS',
                'rating' => 5,
                'stats' => ['2x repeat customers', '3,500 loyalty members'],
            ],
            [
                'name' => 'Maria Kigongo',
                'role' => 'Director',
                'company' => 'Glow Beauty Spa',
                'location' => 'Mbarara',
                'industry' => 'Beauty',
                'quote' => 'Birthday rewards and referral bonuses work perfectly. Our clients bring friends because they each earn UGX 10,000 credit. Best marketing investment we\'ve made.',
                'avatar' => 'MK',
                'rating' => 5,
                'stats' => ['35% referral rate', 'UGX 8M saved on advertising'],
            ],
        ];
        SanaaCardsPageSetting::set('testimonials', $testimonials, 'json');

        // =================================================================
        // TRUST INDICATORS
        // =================================================================
        $trust = [
            ['icon' => 'shield', 'text' => 'Bank-Grade Security'],
            ['icon' => 'lock', 'text' => 'SSL Encrypted'],
            ['icon' => 'server', 'text' => '99.9% Uptime'],
            ['icon' => 'support', 'text' => '24/7 Uganda Support'],
            ['icon' => 'pos', 'text' => 'Works with Any POS'],
        ];
        SanaaCardsPageSetting::set('trust_items', $trust, 'json');

        // =================================================================
        // CTA SECTION
        // =================================================================
        SanaaCardsPageSetting::set('cta_title', 'Start Building Customer Loyalty Today', 'text');
        SanaaCardsPageSetting::set('cta_subtitle', 'Join 50+ Ugandan businesses using Sanaa Cards to grow repeat revenue. Setup takes less than 24 hours.', 'text');
        SanaaCardsPageSetting::set('cta_guarantee', 'No credit card required • 14-day free trial • Cancel anytime', 'text');
    }
}
