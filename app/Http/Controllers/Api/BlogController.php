<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Models\BlogAnalytics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BlogController extends Controller
{
    /**
     * List blogs with advanced filtering, sorting and pagination.
     */
    public function index(Request $request)
    {
        $query = Blog::query()
            ->with(['author', 'category', 'tags'])
            ->published();

        // Filters
        if ($search = $request->query('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('body', 'like', "%{$search}%");
            });
        }

        if ($author = $request->query('author')) {
            // supports numeric author id
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

        if ($from = $request->query('from')) {
            $query->where('published_at', '>=', $from);
        }
        if ($to = $request->query('to')) {
            $query->where('published_at', '<=', $to);
        }

        // Sorting
        $sort = $request->query('sort', '-published_at');
        $direction = str_starts_with($sort, '-') ? 'desc' : 'asc';
        $column = ltrim($sort, '-');
        $allowedSorts = [
            'published_at', 'created_at', 'views', 'likes', 'shares', 'reading_time'
        ];
        if ($column === 'popularity') {
            $query->orderByRaw('(views + likes * 5 + shares * 10 + bookmarks * 3) ' . $direction);
        } elseif (in_array($column, $allowedSorts, true)) {
            $query->orderBy($column, $direction);
        } else {
            $query->orderByDesc('published_at');
        }

        // Pagination
        $perPage = (int) min(max((int) $request->query('per_page', 12), 1), 50);
        $blogs = $query->paginate($perPage)->appends($request->query());

        return BlogResource::collection($blogs);
    }

    /**
     * Trending blogs (7-day window, engagement weighted)
     */
    public function trending(Request $request)
    {
        $perPage = (int) min(max((int) $request->query('per_page', 10), 1), 50);
        $blogs = Blog::trending()->with(['author', 'category', 'tags'])->paginate($perPage);
        return BlogResource::collection($blogs);
    }

    /**
     * Featured blogs
     */
    public function featured(Request $request)
    {
        $perPage = (int) min(max((int) $request->query('per_page', 10), 1), 50);
        $blogs = Blog::published()->featured()->with(['author', 'category', 'tags'])->orderByDesc('published_at')->paginate($perPage);
        return BlogResource::collection($blogs);
    }

    /**
     * Blog detail. Increments view count once per IP per hour via analytics.
     */
    public function show(Request $request, Blog $blog)
    {
        // Only show published and not future-dated
        if ($blog->status !== 'published' || ($blog->published_at && $blog->published_at->isFuture())) {
            abort(404);
        }

        $ip = $request->ip();
        $cacheKey = "blog_viewed_api_{$blog->id}_{$ip}";
        if (!Cache::has($cacheKey)) {
            $blog->increment('views');
            BlogAnalytics::create([
                'blog_id' => $blog->id,
                'ip_address' => $ip,
                'user_agent' => $request->userAgent(),
                'referrer' => $request->header('referer'),
                'event_type' => 'page_view',
                'metadata' => ['source' => 'api']
            ]);
            Cache::put($cacheKey, true, now()->addHour());
        }

        $blog->load(['author', 'category', 'tags']);
        return new BlogResource($blog);
    }

    public function like(Request $request, Blog $blog)
    {
        $ip = $request->ip();
        $already = BlogAnalytics::where('blog_id', $blog->id)
            ->where('event_type', 'like')
            ->where('ip_address', $ip)
            ->where('created_at', '>=', now()->subDay())
            ->exists();

        if (!$already) {
            $blog->increment('likes');
            BlogAnalytics::create([
                'blog_id' => $blog->id,
                'ip_address' => $ip,
                'user_agent' => $request->userAgent(),
                'event_type' => 'like',
                'metadata' => ['source' => 'api']
            ]);
        }

        return response()->json([
            'likes' => $blog->fresh()->likes,
            'liked' => true,
            'throttled' => $already,
        ]);
    }

    public function share(Request $request, Blog $blog)
    {
        $blog->increment('shares');
        BlogAnalytics::create([
            'blog_id' => $blog->id,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'event_type' => 'share',
            'metadata' => [
                'platform' => $request->input('platform', 'unknown'),
                'referrer' => $request->header('referer'),
                'source' => 'api'
            ]
        ]);

        return response()->json([
            'shares' => $blog->fresh()->shares,
        ]);
    }

    public function save(Request $request, Blog $blog)
    {
        $ip = $request->ip();
        $already = BlogAnalytics::where('blog_id', $blog->id)
            ->where('event_type', 'bookmark')
            ->where('ip_address', $ip)
            ->where('created_at', '>=', now()->subDay())
            ->exists();

        if (!$already) {
            $blog->increment('bookmarks');
            BlogAnalytics::create([
                'blog_id' => $blog->id,
                'ip_address' => $ip,
                'user_agent' => $request->userAgent(),
                'event_type' => 'bookmark',
                'metadata' => ['source' => 'api']
            ]);
        }

        return response()->json([
            'bookmarks' => $blog->fresh()->bookmarks,
            'bookmarked' => true,
            'throttled' => $already,
        ]);
    }
}
