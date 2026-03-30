<?php

namespace Database\Seeders;

use App\Models\SiteMenu;
use Illuminate\Database\Seeder;

class SiteMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing menus
        SiteMenu::truncate();

        // ==========================================
        // MAIN NAVIGATION
        // ==========================================
        
        // Home
        SiteMenu::create([
            'location' => 'main',
            'label' => 'Home',
            'route_name' => 'home',
            'sort_order' => 1,
        ]);

        // 1. Solutions (Industries) - High-level entrance for business owners
        $solutions = SiteMenu::create([
            'location' => 'main',
            'label' => 'Solutions',
            'url' => '#',
            'sort_order' => 2,
            'icon' => 'briefcase',
            'description' => 'Built for your business needs',
        ]);

        SiteMenu::create([
            'location' => 'main',
            'label' => 'Restaurants',
            'url' => '#',
            'parent_id' => $solutions->id,
            'sort_order' => 1,
            'icon' => 'utensils',
            'description' => 'From fine dining to food trucks',
        ]);

        SiteMenu::create([
            'location' => 'main',
            'label' => 'Retail',
            'url' => '#',
            'parent_id' => $solutions->id,
            'sort_order' => 2,
            'icon' => 'shopping-bag',
            'description' => 'Modern trade and brick-and-mortar stores',
        ]);

        SiteMenu::create([
            'location' => 'main',
            'label' => 'Professional Services',
            'url' => '#',
            'parent_id' => $solutions->id,
            'sort_order' => 3,
            'icon' => 'user-check',
            'description' => 'Lawyers, consultants, and agencies',
        ]);

        // 2. Products - Categorized like Square
        $products = SiteMenu::create([
            'location' => 'main',
            'label' => 'Products',
            'url' => '#',
            'sort_order' => 3,
            'icon' => 'layout-grid',
            'description' => 'The tools to run your business',
        ]);

        // Software Sub-category (Conceptualized labels for now)
        $software = SiteMenu::create([
            'location' => 'main',
            'label' => 'Software',
            'url' => '#',
            'parent_id' => $products->id,
            'sort_order' => 1,
            'icon' => 'monitor',
            'description' => 'Cloud POS & Management'
        ]);

        SiteMenu::create([
            'location' => 'main',
            'label' => 'Sanaa Cloud POS',
            'url' => '#',
            'parent_id' => $software->id,
            'sort_order' => 1,
            'icon' => 'layout',
            'description' => 'Next-gen point of sale software'
        ]);

        SiteMenu::create([
            'location' => 'main',
            'label' => 'Bulk SMS & CRM',
            'route_name' => 'bulk-sms',
            'parent_id' => $software->id,
            'sort_order' => 2,
            'icon' => 'message-square',
            'description' => 'Engagement and retention tools'
        ]);

        // Hardware Sub-category
        $hardware = SiteMenu::create([
            'location' => 'main',
            'label' => 'Hardware',
            'url' => '#',
            'parent_id' => $products->id,
            'sort_order' => 2,
            'icon' => 'smartphone',
            'description' => 'Terminals & Readers'
        ]);

        SiteMenu::create([
            'location' => 'main',
            'label' => 'POS Terminals',
            'url' => '#',
            'parent_id' => $hardware->id,
            'sort_order' => 1,
            'icon' => 'tablet',
            'description' => 'Professional touch-screen hardware'
        ]);

        // Banking Sub-category
        $banking = SiteMenu::create([
            'location' => 'main',
            'label' => 'Banking',
            'url' => '#',
            'parent_id' => $products->id,
            'sort_order' => 3,
            'icon' => 'banknote',
            'description' => 'Cards & Capital'
        ]);

        SiteMenu::create([
            'location' => 'main',
            'label' => 'Sanaa Cards',
            'route_name' => 'sanaa-cards.index',
            'parent_id' => $banking->id,
            'sort_order' => 1,
            'icon' => 'credit-card',
            'description' => 'Business loyalty & membership cards',
            'badge' => 'POPULAR',
            'badge_color' => 'emerald',
        ]);

        // 3. Developers (Simplified for Conversion)
        SiteMenu::create([
            'location' => 'main',
            'label' => 'Developers',
            'route_name' => 'developer-platforms',
            'sort_order' => 4,
            'icon' => 'code-2',
            'description' => 'API documentation and SDKs',
        ]);

        // Company (with dropdown)
        $company = SiteMenu::create([
            'location' => 'main',
            'label' => 'Company',
            'url' => '#',
            'sort_order' => 4,
            'icon' => 'building-2',
            'description' => 'Learn more about our mission and team',
        ]);

        SiteMenu::create([
            'location' => 'main',
            'label' => 'About Us',
            'route_name' => 'company',
            'parent_id' => $company->id,
            'sort_order' => 1,
            'icon' => 'info',
            'description' => 'Our story, values, and the people behind Sanaa',
        ]);

        SiteMenu::create([
            'location' => 'main',
            'label' => 'Careers',
            'route_name' => 'careers',
            'parent_id' => $company->id,
            'sort_order' => 2,
            'icon' => 'briefcase',
            'description' => 'Join us in building the future of African commerce',
        ]);

        SiteMenu::create([
            'location' => 'main',
            'label' => 'Partners',
            'route_name' => 'partners',
            'parent_id' => $company->id,
            'sort_order' => 3,
            'icon' => 'users',
            'description' => 'Explore our ecosystem of integrated partners',
        ]);

        SiteMenu::create([
            'location' => 'main',
            'label' => 'Investor Relations',
            'route_name' => 'investor-relations',
            'parent_id' => $company->id,
            'sort_order' => 4,
            'icon' => 'trending-up',
            'description' => 'Financial news, filings, and shareholder info',
        ]);

        SiteMenu::create([
            'location' => 'main',
            'label' => 'Blog',
            'route_name' => 'blog.index',
            'parent_id' => $company->id,
            'sort_order' => 5,
            'icon' => 'fountain-pen-nib',
            'description' => 'Latest insights, product updates, and news',
        ]);

        // Soko 24 (external)
        SiteMenu::create([
            'location' => 'main',
            'label' => 'Soko 24',
            'url' => 'https://soko.sanaa.co',
            'sort_order' => 5,
            'is_external' => true,
            'icon' => 'shopping-cart',
            'description' => 'The ultimate African marketplace',
        ]);

        // ==========================================
        // FOOTER NAVIGATION
        // ==========================================
        
        // Products & Services
        $footerProducts = SiteMenu::create([
            'location' => 'footer',
            'label' => 'Products & Services',
            'url' => '#',
            'sort_order' => 1,
        ]);

        foreach ([
            ['Services', 'services', 1],
            ['Products', 'products', 2],
            ['Sanaa Cards', 'sanaa-cards.index', 3],
            ['Pricing', 'prices', 4],
        ] as $item) {
            SiteMenu::create([
                'location' => 'footer',
                'label' => $item[0],
                'route_name' => $item[1],
                'parent_id' => $footerProducts->id,
                'sort_order' => $item[2],
            ]);
        }

        // Company
        $footerCompany = SiteMenu::create([
            'location' => 'footer',
            'label' => 'Company',
            'url' => '#',
            'sort_order' => 2,
        ]);

        foreach ([
            ['About Us', 'about', 1],
            ['Careers', 'careers', 2],
            ['Partners', 'partners', 3],
            ['Contact', 'contact', 4],
        ] as $item) {
            SiteMenu::create([
                'location' => 'footer',
                'label' => $item[0],
                'route_name' => $item[1],
                'parent_id' => $footerCompany->id,
                'sort_order' => $item[2],
            ]);
        }

        // Resources
        $footerResources = SiteMenu::create([
            'location' => 'footer',
            'label' => 'Resources',
            'url' => '#',
            'sort_order' => 3,
        ]);

        foreach ([
            ['Blog', 'blog.index', 1],
            ['Support', 'support', 2],
            ['Why Sanaa', 'why-sanaa', 3],
        ] as $item) {
            SiteMenu::create([
                'location' => 'footer',
                'label' => $item[0],
                'route_name' => $item[1],
                'parent_id' => $footerResources->id,
                'sort_order' => $item[2],
            ]);
        }

        // Legal
        $footerLegal = SiteMenu::create([
            'location' => 'footer',
            'label' => 'Legal',
            'url' => '#',
            'sort_order' => 4,
        ]);

        foreach ([
            ['Privacy Policy', 'policies.privacy-notice', 1],
            ['Terms of Service', 'terms', 2],
            ['Security', 'policies.security', 3],
        ] as $item) {
            SiteMenu::create([
                'location' => 'footer',
                'label' => $item[0],
                'route_name' => $item[1],
                'parent_id' => $footerLegal->id,
                'sort_order' => $item[2],
            ]);
        }

        // ==========================================
        // BLOG NAVIGATION
        // ==========================================

        SiteMenu::create([
            'location' => 'blog',
            'label' => 'All Posts',
            'route_name' => 'blog.index',
            'sort_order' => 1,
            'icon' => 'newspaper',
        ]);

        SiteMenu::create([
            'location' => 'blog',
            'label' => 'For You',
            'route_name' => 'blog.index',  // Can add ?filter=for-you
            'sort_order' => 2,
            'icon' => 'user',
            'description' => 'Personalized content based on your interests',
        ]);

        SiteMenu::create([
            'location' => 'blog',
            'label' => 'Featured',
            'route_name' => 'blog.index',  // Can add ?filter=featured
            'sort_order' => 3,
            'icon' => 'star',
            'description' => 'Editor picks and trending articles',
        ]);

        SiteMenu::create([
            'location' => 'blog',
            'label' => 'Technology',
            'route_name' => 'blog.category',  // Can be blog.category with slug
            'sort_order' => 4,
            'icon' => 'cpu',
        ]);

        SiteMenu::create([
            'location' => 'blog',
            'label' => 'Business',
            'route_name' => 'blog.category',
            'sort_order' => 5,
            'icon' => 'briefcase',
        ]);

        SiteMenu::create([
            'location' => 'blog',
            'label' => 'Design',
            'route_name' => 'blog.category',
            'sort_order' => 6,
            'icon' => 'palette',
        ]);

        // ==========================================
        // FINANCE NAVIGATION
        // ==========================================

        SiteMenu::create([
            'location' => 'finance',
            'label' => 'Overview',
            'route_name' => 'finance.index',
            'sort_order' => 1,
            'icon' => 'home',
        ]);

        SiteMenu::create([
            'location' => 'finance',
            'label' => 'Solutions',
            'route_name' => 'finance.solutions',
            'sort_order' => 2,
            'icon' => 'layout-grid',
        ]);

        SiteMenu::create([
            'location' => 'finance',
            'label' => 'Pricing',
            'route_name' => 'finance.pricing',
            'sort_order' => 3,
            'icon' => 'tag',
        ]);

        SiteMenu::create([
            'location' => 'finance',
            'label' => 'Cards',
            'route_name' => 'sanaa-cards.index',
            'sort_order' => 4,
            'icon' => 'credit-card',
            'badge' => 'NEW',
            'badge_color' => 'emerald',
        ]);

        SiteMenu::create([
            'location' => 'finance',
            'label' => 'Team',
            'route_name' => 'team',
            'sort_order' => 5,
            'icon' => 'users',
        ]);

        SiteMenu::create([
            'location' => 'finance',
            'label' => 'Compliance',
            'route_name' => 'policies.security',
            'sort_order' => 6,
            'icon' => 'shield-check',
        ]);

        SiteMenu::create([
            'location' => 'finance',
            'label' => 'Resources',
            'route_name' => 'blog.index',
            'sort_order' => 7,
            'icon' => 'book-open',
        ]);

        SiteMenu::create([
            'location' => 'finance',
            'label' => 'News & Insights',
            'route_name' => 'blog.index',
            'sort_order' => 8,
            'icon' => 'newspaper',
        ]);

        SiteMenu::create([
            'location' => 'finance',
            'label' => 'Contact Sales',
            'route_name' => 'contact',
            'sort_order' => 9,
            'icon' => 'phone',
        ]);

        $this->command->info('Site menus seeded successfully with main, footer, blog, and finance navigation!');
    }
}
