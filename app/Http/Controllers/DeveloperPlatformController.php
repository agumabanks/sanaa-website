<?php

namespace App\Http\Controllers;

use App\Models\DeveloperPlatform;
use Illuminate\Http\Request;

class DeveloperPlatformController extends Controller
{
    public function index()
    {
        $items = DeveloperPlatform::query()->orderBy('name')->get();

        $listUrl = url('/api/v1/insights');
        $latestUrl = url('/api/v1/insights/latest');
        $manifestUrl = url('/api/v1/insights/manifest');
        $detailUrl = url('/api/v1/insights/{slug}');
        $feedJsonUrl = route('blog.feed.json');
        $feedXmlUrl = route('blog.feed');

        $docs = [
            'name' => 'Sanaa Blog Syndication API',
            'summary' => 'A public read-only API for distributing Sanaa blog insights across your websites, mobile apps, landing pages, newsletters, and partner integrations.',
            'base_url' => url('/api/v1'),
            'auth' => 'No API key is required for read access to these blog endpoints.',
            'cors' => config('cors.allowed_origins') === ['*']
                ? 'Cross-origin requests are enabled, so browser-side fetches from your other domains can consume these endpoints directly.'
                : 'Cross-origin access is restricted. Use server-side fetching or explicitly approved origins.',
            'cache' => 'Responses return cache headers for short-lived syndication caching: max-age=300 and s-maxage=600.',
            'feeds' => [
                ['label' => 'JSON Feed', 'url' => $feedJsonUrl],
                ['label' => 'XML Feed', 'url' => $feedXmlUrl],
                ['label' => 'Manifest', 'url' => $manifestUrl],
            ],
            'endpoints' => [
                [
                    'method' => 'GET',
                    'path' => '/api/v1/insights',
                    'url' => $listUrl,
                    'purpose' => 'Paginated list of published insights for index pages, content rails, and archive views.',
                ],
                [
                    'method' => 'GET',
                    'path' => '/api/v1/insights/latest',
                    'url' => $latestUrl,
                    'purpose' => 'Small non-paginated result sets for homepage widgets, footers, or featured cards.',
                ],
                [
                    'method' => 'GET',
                    'path' => '/api/v1/insights/{slug}',
                    'url' => $detailUrl,
                    'purpose' => 'Single published article by slug for article detail pages or cached content imports.',
                ],
                [
                    'method' => 'GET',
                    'path' => '/api/v1/insights/manifest',
                    'url' => $manifestUrl,
                    'purpose' => 'Machine-readable summary of the syndication API for integrators and tooling.',
                ],
            ],
            'query_parameters' => [
                ['name' => 'per_page', 'type' => 'integer', 'scope' => 'list', 'description' => 'Number of results per page. Range: 1 to 50.', 'example' => '12'],
                ['name' => 'page', 'type' => 'integer', 'scope' => 'list', 'description' => 'Pagination page number for the list endpoint.', 'example' => '2'],
                ['name' => 'limit', 'type' => 'integer', 'scope' => 'latest', 'description' => 'Number of latest items to return. Range: 1 to 30.', 'example' => '6'],
                ['name' => 'q', 'type' => 'string', 'scope' => 'list, latest', 'description' => 'Full-text search across title, excerpt, and body.', 'example' => 'payments'],
                ['name' => 'category', 'type' => 'id or slug', 'scope' => 'list, latest', 'description' => 'Filter by blog category.', 'example' => 'business'],
                ['name' => 'tag', 'type' => 'id or slug', 'scope' => 'list, latest', 'description' => 'Filter by blog tag.', 'example' => 'fintech'],
                ['name' => 'author', 'type' => 'integer', 'scope' => 'list, latest', 'description' => 'Filter by author ID.', 'example' => '4'],
                ['name' => 'featured', 'type' => 'boolean', 'scope' => 'list, latest', 'description' => 'Return only featured posts.', 'example' => '1'],
                ['name' => 'updated_since', 'type' => 'ISO 8601 datetime', 'scope' => 'list, latest', 'description' => 'Return content updated on or after a specific timestamp.', 'example' => '2026-04-01T00:00:00Z'],
                ['name' => 'include', 'type' => 'string', 'scope' => 'list, latest, detail', 'description' => 'Set to body to include article body in the payload.', 'example' => 'body'],
                ['name' => 'format', 'type' => 'string', 'scope' => 'list, latest, detail', 'description' => 'When body is included, choose html or text.', 'example' => 'text'],
                ['name' => 'include_body', 'type' => 'boolean', 'scope' => 'list, latest, detail', 'description' => 'Alternative boolean switch for including body content.', 'example' => '1'],
            ],
            'response_fields' => [
                ['field' => 'id', 'description' => 'Internal blog ID.'],
                ['field' => 'slug', 'description' => 'Stable article identifier for detail fetches.'],
                ['field' => 'title', 'description' => 'Blog headline.'],
                ['field' => 'excerpt', 'description' => 'Short summary for cards and previews.'],
                ['field' => 'body', 'description' => 'Nullable unless include=body or include_body=1 is provided.'],
                ['field' => 'reading_time', 'description' => 'Estimated reading time in minutes.'],
                ['field' => 'featured', 'description' => 'Boolean featured flag.'],
                ['field' => 'published_at / updated_at', 'description' => 'ISO 8601 timestamps.'],
                ['field' => 'url', 'description' => 'Canonical article URL on sanaa.ug.'],
                ['field' => 'featured_image_url', 'description' => 'Resolved public image URL.'],
                ['field' => 'seo.meta_title / meta_description / keywords', 'description' => 'SEO payload for reuse on partner pages.'],
                ['field' => 'stats.views / likes / shares / bookmarks', 'description' => 'Public engagement counters.'],
                ['field' => 'author / category / tags', 'description' => 'Nested metadata for attribution and taxonomy.'],
            ],
            'examples' => [
                [
                    'label' => 'Homepage rail',
                    'url' => $latestUrl . '?limit=6',
                ],
                [
                    'label' => 'Featured homepage rail',
                    'url' => $latestUrl . '?limit=6&featured=1',
                ],
                [
                    'label' => 'Search with body text',
                    'url' => $listUrl . '?q=payments&include=body&format=text',
                ],
                [
                    'label' => 'Business category archive',
                    'url' => $listUrl . '?category=business&per_page=9',
                ],
                [
                    'label' => 'Incremental sync after an update',
                    'url' => $listUrl . '?updated_since=2026-04-01T00:00:00Z',
                ],
            ],
            'javascript_example' => <<<JS
const response = await fetch('{$latestUrl}?limit=6&featured=1');
const payload = await response.json();

payload.data.forEach((post) => {
  console.log(post.title, post.url, post.seo.meta_description);
});
JS,
            'php_example' => <<<PHP
use Illuminate\Support\Facades\Http;

\$payload = Http::timeout(5)
    ->acceptJson()
    ->get('{$listUrl}', [
        'per_page' => 6,
        'category' => 'business',
    ])
    ->throw()
    ->json();

foreach (\$payload['data'] as \$post) {
    echo \$post['title'] . PHP_EOL;
}
PHP,
            'sample_response' => json_encode([
                'data' => [[
                    'id' => 25,
                    'slug' => 'the-reason-your-lending-business-isnt-growing',
                    'title' => 'The Reason Your Lending Business Isn\'t Growing Isn\'t Capital. It\'s Control.',
                    'excerpt' => 'Most lending businesses we work with have the same problem. Not enough borrowers? No. Their books are full.',
                    'body' => null,
                    'reading_time' => 4,
                    'featured' => true,
                    'published_at' => '2026-04-04T10:30:00Z',
                    'updated_at' => '2026-04-05T07:15:00Z',
                    'url' => url('/blog/the-reason-your-lending-business-isnt-growing'),
                    'featured_image_url' => url('/storage/blog/featured/control.jpg'),
                    'seo' => [
                        'meta_title' => 'The Reason Your Lending Business Isn\'t Growing | Finance',
                        'meta_description' => 'Why lending businesses stall when operations, visibility, and financial controls fall behind growth.',
                        'keywords' => 'Lending, Finance, Growth, Control, Sanaa',
                    ],
                    'stats' => [
                        'views' => 1240,
                        'likes' => 41,
                        'shares' => 12,
                        'bookmarks' => 19,
                    ],
                    'author' => [
                        'id' => 1,
                        'name' => 'Sanaa Team',
                        'url' => null,
                    ],
                    'category' => [
                        'id' => 2,
                        'name' => 'Finance',
                        'slug' => 'finance',
                        'url' => url('/blog/category/finance'),
                    ],
                    'tags' => [
                        ['id' => 7, 'name' => 'Lending', 'slug' => 'lending', 'url' => url('/blog/tag/lending')],
                    ],
                ]],
                'meta' => [
                    'count' => 1,
                    'generated_at' => now()->toISOString(),
                ],
                'links' => [
                    'self' => $latestUrl . '?limit=1',
                    'all' => $listUrl,
                ],
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES),
        ];

        return view('pages.developer-platforms', compact('items', 'docs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);
        DeveloperPlatform::create($data);
        return redirect()->route('dashboard.developer-platforms')->with('status', 'Developer platform created');
    }
}
