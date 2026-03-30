<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Blog;
use App\Models\FinancePage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:sanaa';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.xml file for sanaa.ug';

    private const BASE_URL = 'https://sanaa.ug';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating sitemap...');

        $items = [];

        // Static pages
        $staticPages = [
            '/' => ['priority' => '1.0', 'changefreq' => 'daily'],
            '/about' => ['priority' => '0.8', 'changefreq' => 'monthly'],
            '/company' => ['priority' => '0.8', 'changefreq' => 'monthly'],
            '/products' => ['priority' => '0.8', 'changefreq' => 'weekly'],
            '/services' => ['priority' => '0.8', 'changefreq' => 'weekly'],
            '/careers' => ['priority' => '0.7', 'changefreq' => 'weekly'],
            '/partners' => ['priority' => '0.7', 'changefreq' => 'monthly'],
            '/team' => ['priority' => '0.7', 'changefreq' => 'monthly'],
            '/contact' => ['priority' => '0.8', 'changefreq' => 'monthly'],
            '/support' => ['priority' => '0.7', 'changefreq' => 'monthly'],
            '/investor-relations' => ['priority' => '0.7', 'changefreq' => 'monthly'],
            '/why-sanaa' => ['priority' => '0.7', 'changefreq' => 'monthly'],
            '/blog' => ['priority' => '0.9', 'changefreq' => 'daily'],
            '/policies' => ['priority' => '0.5', 'changefreq' => 'monthly'],
            '/policies/privacy-notice' => ['priority' => '0.5', 'changefreq' => 'monthly'],
            '/policies/terms-conditions' => ['priority' => '0.5', 'changefreq' => 'monthly'],
            '/developer-platforms' => ['priority' => '0.6', 'changefreq' => 'monthly'],
            '/finance' => ['priority' => '0.8', 'changefreq' => 'weekly'],
            '/finance/overview' => ['priority' => '0.7', 'changefreq' => 'monthly'],
            '/finance/pricing' => ['priority' => '0.7', 'changefreq' => 'monthly'],
            '/finance/cards' => ['priority' => '0.7', 'changefreq' => 'monthly'],
            '/finance/technologies' => ['priority' => '0.7', 'changefreq' => 'monthly'],
            '/finance/team' => ['priority' => '0.6', 'changefreq' => 'monthly'],
            '/finance/communities' => ['priority' => '0.6', 'changefreq' => 'monthly'],
            '/finance/compliance' => ['priority' => '0.6', 'changefreq' => 'monthly'],
            '/finance/resources' => ['priority' => '0.6', 'changefreq' => 'monthly'],
            '/finance/contact-sales' => ['priority' => '0.7', 'changefreq' => 'monthly'],
        ];

        foreach ($staticPages as $path => $data) {
            $items[] = [
                'loc' => self::BASE_URL . $path,
                'priority' => $data['priority'],
                'changefreq' => $data['changefreq']
            ];
        }

        // Blog posts
        try {
            Blog::published()->latest()->each(function ($blog) use (&$items) {
                $items[] = [
                    'loc' => self::BASE_URL . '/blog/' . $blog->slug,
                    'lastmod' => optional($blog->updated_at)->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.6',
                ];
            });
        } catch (\Exception $e) {
            $this->warn('Could not add blogs to sitemap: ' . $e->getMessage());
        }

        // Dynamic finance pages
        try {
            FinancePage::published()->each(function ($page) use (&$items) {
                $items[] = [
                    'loc' => self::BASE_URL . '/finance/p/' . $page->slug,
                    'lastmod' => optional($page->updated_at)->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.5',
                ];
            });
        } catch (\Exception $e) {
            $this->warn('Could not add finance pages to sitemap: ' . $e->getMessage());
        }

        $xml = View::make('partials.sitemap-urlset', compact('items'))->render();
        File::put(public_path('sitemap.xml'), $xml);

        $this->info('Sitemap generated successfully at ' . public_path('sitemap.xml'));
    }
}
