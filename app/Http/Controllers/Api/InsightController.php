<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class InsightController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $perPage = (int) min(max((int) $request->query('per_page', 12), 1), 50);

        $insights = $this->buildQuery($request)
            ->paginate($perPage)
            ->appends($request->query());

        return $this->asSyndicationResponse($insights, $request);
    }

    public function latest(Request $request): JsonResponse
    {
        $limit = (int) min(max((int) $request->query('limit', 10), 1), 30);

        $blogs = $this->buildQuery($request)
            ->limit($limit)
            ->get();

        return response()
            ->json([
                'data' => $blogs->map(fn (Blog $blog) => $this->transformInsight($blog, $request))->values(),
                'meta' => [
                    'count' => $blogs->count(),
                    'generated_at' => now()->toISOString(),
                ],
                'links' => [
                    'self' => $request->fullUrl(),
                    'all' => url('/api/v1/insights'),
                ],
            ])
            ->header('Cache-Control', 'public, max-age=300, s-maxage=600');
    }

    public function show(Request $request, Blog $blog): JsonResponse
    {
        if ($blog->status !== 'published' || ($blog->published_at && $blog->published_at->isFuture())) {
            abort(404);
        }

        $blog->load(['author', 'category', 'tags']);

        return response()
            ->json([
                'data' => $this->transformInsight($blog, $request),
                'meta' => [
                    'generated_at' => now()->toISOString(),
                ],
                'links' => [
                    'self' => $request->fullUrl(),
                    'all' => url('/api/v1/insights'),
                ],
            ])
            ->header('Cache-Control', 'public, max-age=300, s-maxage=600');
    }

    public function manifest(Request $request): JsonResponse
    {
        return response()->json([
            'name' => 'Sanaa Insights API',
            'version' => '1.0',
            'description' => 'Syndicate Sanaa blog insights across websites and apps.',
            'documentation' => route('developer-platforms'),
            'endpoints' => [
                'list' => url('/api/v1/insights'),
                'latest' => url('/api/v1/insights/latest'),
                'detail' => url('/api/v1/insights/{slug}'),
                'feed_json' => route('blog.feed.json'),
                'feed_xml' => route('blog.feed'),
            ],
            'filters' => [
                'q',
                'category (id|slug)',
                'tag (id|slug)',
                'author (id)',
                'featured (boolean)',
                'updated_since (ISO date)',
                'per_page (1-50)',
                'include (body)',
                'format (html|text)',
            ],
            'examples' => [
                'latest featured' => url('/api/v1/insights/latest?limit=6&featured=1'),
                'search + include body' => url('/api/v1/insights?q=payments&include=body&format=text'),
            ],
            'generated_at' => now()->toISOString(),
            'requested_url' => $request->fullUrl(),
        ]);
    }

    private function buildQuery(Request $request)
    {
        $query = Blog::query()
            ->with(['author', 'category', 'tags'])
            ->published()
            ->orderByRaw('COALESCE(published_at, created_at) DESC')
            ->orderByDesc('id');

        if ($search = trim((string) $request->query('q'))) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('body', 'like', "%{$search}%");
            });
        }

        if ($author = $request->query('author')) {
            $query->where('author_id', $author);
        }

        if ($category = $request->query('category')) {
            $query->whereHas('category', function ($q) use ($category) {
                if (is_numeric($category)) {
                    $q->where('id', $category);
                } else {
                    $q->where('slug', $category);
                }
            });
        }

        if ($tag = $request->query('tag')) {
            $query->whereHas('tags', function ($q) use ($tag) {
                if (is_numeric($tag)) {
                    $q->where('blog_tag_id', $tag);
                } else {
                    $q->where('slug', $tag);
                }
            });
        }

        if ($request->boolean('featured')) {
            $query->where('featured', true);
        }

        if ($updatedSince = $request->query('updated_since')) {
            $query->where('updated_at', '>=', $updatedSince);
        }

        return $query;
    }

    private function asSyndicationResponse(LengthAwarePaginator $insights, Request $request): JsonResponse
    {
        return response()
            ->json([
                'data' => $insights->getCollection()->map(
                    fn (Blog $blog) => $this->transformInsight($blog, $request)
                )->values(),
                'meta' => [
                    'current_page' => $insights->currentPage(),
                    'per_page' => $insights->perPage(),
                    'total' => $insights->total(),
                    'last_page' => $insights->lastPage(),
                    'generated_at' => now()->toISOString(),
                ],
                'links' => [
                    'self' => $request->fullUrl(),
                    'next' => $insights->nextPageUrl(),
                    'prev' => $insights->previousPageUrl(),
                ],
            ])
            ->header('Cache-Control', 'public, max-age=300, s-maxage=600');
    }

    private function transformInsight(Blog $blog, Request $request): array
    {
        $includeBody = str_contains((string) $request->query('include', ''), 'body')
            || $request->boolean('include_body');
        $format = strtolower((string) $request->query('format', 'html'));

        $bodyHtml = (string) ($blog->body ?? '');
        $bodyText = trim(preg_replace('/\s+/', ' ', preg_replace('/<[^>]+>/', ' ', $bodyHtml)));

        return [
            'id' => $blog->id,
            'slug' => $blog->slug,
            'title' => $blog->title,
            'excerpt' => $blog->excerpt,
            'body' => $includeBody ? ($format === 'text' ? $bodyText : $bodyHtml) : null,
            'reading_time' => $blog->reading_time,
            'featured' => (bool) $blog->featured,
            'published_at' => optional($blog->published_at ?: $blog->created_at)->toISOString(),
            'updated_at' => optional($blog->updated_at)->toISOString(),
            'url' => $blog->url,
            'featured_image_url' => $blog->featured_image_url,
            'seo' => [
                'meta_title' => $blog->meta_title ?: $blog->title,
                'meta_description' => $blog->meta_description ?: Str::limit(strip_tags($blog->excerpt), 160),
                'keywords' => $blog->keywords,
            ],
            'stats' => [
                'views' => (int) $blog->views,
                'likes' => (int) $blog->likes,
                'shares' => (int) $blog->shares,
                'bookmarks' => (int) $blog->bookmarks,
            ],
            'author' => $blog->author ? [
                'id' => $blog->author->id,
                'name' => $blog->author->name,
                'url' => $blog->author->author_url,
            ] : null,
            'category' => $blog->category ? [
                'id' => $blog->category->id,
                'name' => $blog->category->name,
                'slug' => $blog->category->slug,
                'url' => route('blog.category', $blog->category->slug),
            ] : null,
            'tags' => $blog->tags->map(fn ($tag) => [
                'id' => $tag->id,
                'name' => $tag->name,
                'slug' => $tag->slug,
            ])->values(),
        ];
    }
}
