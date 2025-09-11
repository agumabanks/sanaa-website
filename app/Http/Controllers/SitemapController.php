<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\FinancePage;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = [
            url('/'),
            route('sitemap.blogs'),
            route('sitemap.finance'),
        ];
        $xml = view('partials.sitemap-index', compact('urls'));
        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    public function blogs(): Response
    {
        $items = method_exists(Blog::class, 'published') ? Blog::published()->latest()->limit(100)->get() : collect();
        $xml = view('partials.sitemap-urlset', ['items' => $items->map(fn($p)=> [
            'loc' => route('blog.index').'/'.$p->slug,
            'lastmod' => optional($p->updated_at)->toAtomString(),
        ])]);
        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    public function finance(): Response
    {
        $static = [
            route('finance.index'),
            route('finance.overview'),
            route('finance.pricing'),
            route('finance.cards'),
            route('finance.technologies'),
            route('finance.team'),
            route('finance.communities'),
            route('finance.compliance'),
            route('finance.resources'),
            route('finance.news-insights'),
            route('finance.contact-sales'),
        ];
        $pages = FinancePage::published()->get()->map(fn($p)=> [
            'loc' => route('finance.show', ['page' => $p->slug]),
            'lastmod' => optional($p->updated_at)->toAtomString(),
        ]);
        $items = collect($static)->map(fn($u)=> ['loc' => $u])->concat($pages);
        $xml = view('partials.sitemap-urlset', compact('items'));
        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
