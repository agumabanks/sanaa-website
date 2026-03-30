<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\FinancePage;
use App\Models\User;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    private const BASE_URL = 'https://sanaa.ug';

    public function index(): Response
    {
        // Single flat sitemap with all URLs (better for Google crawling)
        $items = [];

        // Static pages
        $items[] = ['loc' => self::BASE_URL . '/', 'priority' => '1.0', 'changefreq' => 'daily'];
        $items[] = ['loc' => self::BASE_URL . '/about', 'priority' => '0.8', 'changefreq' => 'monthly'];
        $items[] = ['loc' => self::BASE_URL . '/company', 'priority' => '0.8', 'changefreq' => 'monthly'];
        $items[] = ['loc' => self::BASE_URL . '/products', 'priority' => '0.8', 'changefreq' => 'weekly'];
        $items[] = ['loc' => self::BASE_URL . '/services', 'priority' => '0.8', 'changefreq' => 'weekly'];
        $items[] = ['loc' => self::BASE_URL . '/careers', 'priority' => '0.7', 'changefreq' => 'weekly'];
        $items[] = ['loc' => self::BASE_URL . '/partners', 'priority' => '0.7', 'changefreq' => 'monthly'];
        $items[] = ['loc' => self::BASE_URL . '/team', 'priority' => '0.7', 'changefreq' => 'monthly'];
        $items[] = ['loc' => self::BASE_URL . '/contact', 'priority' => '0.8', 'changefreq' => 'monthly'];
        $items[] = ['loc' => self::BASE_URL . '/support', 'priority' => '0.7', 'changefreq' => 'monthly'];
        $items[] = ['loc' => self::BASE_URL . '/investor-relations', 'priority' => '0.7', 'changefreq' => 'monthly'];
        $items[] = ['loc' => self::BASE_URL . '/why-sanaa', 'priority' => '0.7', 'changefreq' => 'monthly'];
        $items[] = ['loc' => self::BASE_URL . '/blog', 'priority' => '0.9', 'changefreq' => 'daily'];
        $items[] = ['loc' => self::BASE_URL . '/policies', 'priority' => '0.5', 'changefreq' => 'monthly'];
        $items[] = ['loc' => self::BASE_URL . '/policies/privacy-notice', 'priority' => '0.5', 'changefreq' => 'monthly'];
        $items[] = ['loc' => self::BASE_URL . '/policies/terms-conditions', 'priority' => '0.5', 'changefreq' => 'monthly'];
        $items[] = ['loc' => self::BASE_URL . '/developer-platforms', 'priority' => '0.6', 'changefreq' => 'monthly'];

        // Finance pages
        $items[] = ['loc' => self::BASE_URL . '/finance', 'priority' => '0.8', 'changefreq' => 'weekly'];
        $items[] = ['loc' => self::BASE_URL . '/finance/overview', 'priority' => '0.7', 'changefreq' => 'monthly'];
        $items[] = ['loc' => self::BASE_URL . '/finance/pricing', 'priority' => '0.7', 'changefreq' => 'monthly'];
        $items[] = ['loc' => self::BASE_URL . '/finance/cards', 'priority' => '0.7', 'changefreq' => 'monthly'];
        $items[] = ['loc' => self::BASE_URL . '/finance/technologies', 'priority' => '0.7', 'changefreq' => 'monthly'];
        $items[] = ['loc' => self::BASE_URL . '/finance/team', 'priority' => '0.6', 'changefreq' => 'monthly'];
        $items[] = ['loc' => self::BASE_URL . '/finance/communities', 'priority' => '0.6', 'changefreq' => 'monthly'];
        $items[] = ['loc' => self::BASE_URL . '/finance/compliance', 'priority' => '0.6', 'changefreq' => 'monthly'];
        $items[] = ['loc' => self::BASE_URL . '/finance/resources', 'priority' => '0.6', 'changefreq' => 'monthly'];
        $items[] = ['loc' => self::BASE_URL . '/finance/contact-sales', 'priority' => '0.7', 'changefreq' => 'monthly'];

        // Blog posts
        try {
            $blogs = Blog::published()->latest()->get();
            foreach ($blogs as $blog) {
                $items[] = [
                    'loc' => self::BASE_URL . '/blog/' . $blog->slug,
                    'lastmod' => optional($blog->updated_at)->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.6',
                ];
            }
        } catch (\Exception $e) {
            // Blog model or published scope not available
        }

        try {
            $authors = User::whereHas('blogs', fn ($query) => $query->published())
                ->orderBy('name')
                ->get();

            foreach ($authors as $author) {
                $items[] = [
                    'loc' => route('blog.author', ['author' => $author->id, 'slug' => $author->author_slug]),
                    'lastmod' => optional($author->updated_at)->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.5',
                ];
            }
        } catch (\Exception $e) {
            // User model or relation not available
        }

        // Dynamic finance pages
        try {
            $financePages = FinancePage::published()->get();
            foreach ($financePages as $page) {
                $items[] = [
                    'loc' => self::BASE_URL . '/finance/p/' . $page->slug,
                    'lastmod' => optional($page->updated_at)->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.5',
                ];
            }
        } catch (\Exception $e) {
            // FinancePage model might not exist
        }

        $xml = view('partials.sitemap-urlset', compact('items'));
        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    public function pages(): Response
    {
        $static = [
            ['loc' => self::BASE_URL . '/', 'priority' => '1.0', 'changefreq' => 'daily'],
            ['loc' => self::BASE_URL . '/about', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => self::BASE_URL . '/company', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => self::BASE_URL . '/products', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['loc' => self::BASE_URL . '/services', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['loc' => self::BASE_URL . '/careers', 'priority' => '0.7', 'changefreq' => 'weekly'],
            ['loc' => self::BASE_URL . '/partners', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['loc' => self::BASE_URL . '/team', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['loc' => self::BASE_URL . '/contact', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => self::BASE_URL . '/support', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['loc' => self::BASE_URL . '/investor-relations', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['loc' => self::BASE_URL . '/why-sanaa', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['loc' => self::BASE_URL . '/blog', 'priority' => '0.9', 'changefreq' => 'daily'],
            ['loc' => self::BASE_URL . '/policies', 'priority' => '0.5', 'changefreq' => 'monthly'],
            ['loc' => self::BASE_URL . '/policies/privacy-notice', 'priority' => '0.5', 'changefreq' => 'monthly'],
            ['loc' => self::BASE_URL . '/policies/terms-conditions', 'priority' => '0.5', 'changefreq' => 'monthly'],
            ['loc' => self::BASE_URL . '/developer-platforms', 'priority' => '0.6', 'changefreq' => 'monthly'],
        ];
        $xml = view('partials.sitemap-urlset', ['items' => $static]);
        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    public function blogs(): Response
    {
        $posts = method_exists(Blog::class, 'published') ? Blog::published()->latest()->limit(100)->get() : collect();
        $authors = User::whereHas('blogs', fn ($query) => $query->published())
            ->orderBy('name')
            ->get();

        $items = $posts->map(fn ($p) => [
            'loc' => self::BASE_URL . '/blog/' . $p->slug,
            'lastmod' => optional($p->updated_at)->toAtomString(),
            'changefreq' => 'weekly',
            'priority' => '0.6',
        ])->concat(
            $authors->map(fn ($author) => [
                'loc' => route('blog.author', ['author' => $author->id, 'slug' => $author->author_slug]),
                'lastmod' => optional($author->updated_at)->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.5',
            ])
        );

        $xml = view('partials.sitemap-urlset', ['items' => $items]);
        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    public function finance(): Response
    {
        $static = [
            self::BASE_URL . '/finance',
            self::BASE_URL . '/finance/overview',
            self::BASE_URL . '/finance/pricing',
            self::BASE_URL . '/finance/cards',
            self::BASE_URL . '/finance/technologies',
            self::BASE_URL . '/finance/team',
            self::BASE_URL . '/finance/communities',
            self::BASE_URL . '/finance/compliance',
            self::BASE_URL . '/finance/resources',
            self::BASE_URL . '/finance/contact-sales',
        ];
        $pages = FinancePage::published()->get()->map(fn($p)=> [
            'loc' => self::BASE_URL . '/finance/p/' . $p->slug,
            'lastmod' => optional($p->updated_at)->toAtomString(),
        ]);
        $items = collect($static)->map(fn($u)=> ['loc' => $u])->concat($pages);
        $xml = view('partials.sitemap-urlset', compact('items'));
        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
