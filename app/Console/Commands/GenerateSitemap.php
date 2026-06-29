<?php

namespace App\Console\Commands;

use App\Models\Blog;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the public/sitemap.xml file';

    public function handle(): int
    {
        $sitemap = Sitemap::create();
        $base = 'https://sanaa.ug';

        // Homepage
        $sitemap->add(Url::create("{$base}/")
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(1.0));

        // Static pages (monthly, 0.8)
        $staticPages = [
            '/about',
            '/careers',
            '/partners',
            '/investor-relations',
            '/contact',
            '/prices',
        ];
        foreach ($staticPages as $page) {
            $sitemap->add(Url::create("{$base}{$page}")
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority(0.8));
        }

        // Product pages (weekly, 0.9)
        $productPages = [
            '/finance',
            '/sanaa-cards',
            '/sanaa-cloud',
        ];
        foreach ($productPages as $page) {
            $sitemap->add(Url::create("{$base}{$page}")
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.9));
        }

        // Blog index (daily, 0.9)
        $sitemap->add(Url::create("{$base}/blog")
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(0.9));

        // Blog posts (weekly, 0.7)
        try {
            Blog::published()->latest()->get()->each(function (Blog $post) use ($sitemap, $base) {
                $sitemap->add(Url::create("{$base}/blog/{$post->slug}")
                    ->setLastModificationDate($post->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.7));
            });
        } catch (\Exception $e) {
            $this->warn('Could not add blog posts: ' . $e->getMessage());
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));
        $this->info('Sitemap generated at public/sitemap.xml');

        return self::SUCCESS;
    }
}
