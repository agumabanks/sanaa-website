<?php
// app/Http/Controllers/BlogController.php (Enhanced)

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\BlogAnalytics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::with(['author', 'category', 'tags'])
            ->published()
            ->orderByDesc('featured')
            ->orderByDesc('published_at');

        // Handle category filtering
        if ($request->has('category') && $request->category) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Handle tag filtering
        if ($request->has('tag') && $request->tag) {
            $query->whereHas('tags', function($q) use ($request) {
                $q->where('slug', $request->tag);
            });
        }

        // Handle infinite scroll AJAX requests
        if ($request->ajax()) {
            $blogs = $query->paginate(6);
            
            $articlesData = $blogs->map(function($blog) {
                return [
                    'id' => $blog->id,
                    'title' => $blog->title,
                    'slug' => $blog->slug,
                    'excerpt' => $blog->excerpt,
                    'featured_image_url' => $blog->featured_image_url,
                    'author' => $blog->author ? $blog->author->name : 'Sanaa Team',
                    'category' => $blog->category ? $blog->category->name : null,
                    'formatted_date' => $blog->formatted_date,
                    'relative_date' => $blog->relative_date,
                    'reading_time' => $blog->reading_time,
                    'views' => number_format($blog->views),
                    'likes' => $blog->likes,
                    'url' => $blog->url,
                    'featured' => $blog->featured
                ];
            });
            
            return response()->json([
                'articles' => $articlesData,
                'has_more' => $blogs->hasMorePages(),
                'next_page' => $blogs->nextPageUrl(),
                'current_page' => $blogs->currentPage()
            ]);
        }

        $blogs = $query->paginate(12);
        $featuredPost = Blog::published()->featured()->first();
        $trendingPosts = $this->getTrendingPosts();
        $categories = $this->getPopularCategories();
        $tags = $this->getPopularTags();

        return view('blog.index', compact('blogs', 'featuredPost', 'trendingPosts', 'categories', 'tags'));
    }

    public function show(Blog $blog, Request $request)
    {
        // Check if blog is published
        if ($blog->status !== 'published' || ($blog->published_at && $blog->published_at > now())) {
            abort(404);
        }

        // Track page view (with session-based duplicate prevention)
        $viewKey = "blog_viewed_{$blog->id}_" . $request->ip();
        if (!Session::has($viewKey)) {
            $blog->incrementViews();
            Session::put($viewKey, true);
        }

        $relatedPosts = $this->getRelatedPosts($blog);
        $readingTime = $blog->reading_time;

        // Check user engagement status
        $userEngagement = $this->getUserEngagement($blog, $request);

        // SEO data
        $seoData = [
            'title' => $blog->meta_title ?: ($blog->title . ' | Sanaa Blog'),
            'description' => $blog->meta_description ?: $blog->excerpt,
            'keywords' => $blog->keywords,
            'image' => $blog->featured_image_url,
            'url' => $blog->url,
            'published_time' => $blog->published_at ? $blog->published_at->toISOString() : $blog->created_at->toISOString(),
            'modified_time' => $blog->updated_at->toISOString(),
            'author' => $blog->author ? $blog->author->name : 'Sanaa Team',
            'reading_time' => $readingTime,
            'category' => $blog->category ? $blog->category->name : null
        ];

        return view('blog.show', compact('blog', 'relatedPosts', 'seoData', 'readingTime', 'userEngagement'));
    }

    public function like(Blog $blog, Request $request)
    {
        $ip = $request->ip();
        $sessionKey = "blog_liked_{$blog->id}_{$ip}";
        
        if (!Session::has($sessionKey)) {
            $blog->increment('likes');
            Session::put($sessionKey, true);
            
            // Track engagement analytics
            BlogAnalytics::create([
                'blog_id' => $blog->id,
                'ip_address' => $ip,
                'user_agent' => $request->userAgent(),
                'event_type' => 'like',
                'metadata' => ['timestamp' => now()->timestamp]
            ]);

            return response()->json([
                'success' => true,
                'likes' => $blog->fresh()->likes,
                'liked' => true,
                'message' => 'Article liked!'
            ]);
        }

        return response()->json([
            'success' => false,
            'likes' => $blog->likes,
            'liked' => true,
            'message' => 'Already liked!'
        ]);
    }

    public function bookmark(Blog $blog, Request $request)
    {
        $ip = $request->ip();
        $sessionKey = "blog_bookmarked_{$blog->id}_{$ip}";
        
        if (!Session::has($sessionKey)) {
            $blog->increment('bookmarks');
            Session::put($sessionKey, true);
            
            BlogAnalytics::create([
                'blog_id' => $blog->id,
                'ip_address' => $ip,
                'user_agent' => $request->userAgent(),
                'event_type' => 'bookmark',
                'metadata' => ['timestamp' => now()->timestamp]
            ]);

            return response()->json([
                'success' => true,
                'bookmarks' => $blog->fresh()->bookmarks,
                'bookmarked' => true,
                'message' => 'Article bookmarked!'
            ]);
        }

        return response()->json([
            'success' => false,
            'bookmarks' => $blog->bookmarks,
            'bookmarked' => true,
            'message' => 'Already bookmarked!'
        ]);
    }

    public function share(Blog $blog, Request $request)
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
                'timestamp' => now()->timestamp
            ]
        ]);

        return response()->json([
            'success' => true,
            'shares' => $blog->fresh()->shares,
            'message' => 'Share tracked!'
        ]);
    }

    public function trackAnalytics(Request $request)
    {
        $validated = $request->validate([
            'blog_id' => 'required|exists:blogs,id',
            'event_type' => 'required|string|in:scroll_depth,reading_time,text_selection,font_change,speed_read',
            'value' => 'nullable|numeric',
            'metadata' => 'nullable|array'
        ]);

        BlogAnalytics::create([
            'blog_id' => $validated['blog_id'],
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'event_type' => $validated['event_type'],
            'value' => $validated['value'] ?? null,
            'metadata' => $validated['metadata'] ?? []
        ]);

        return response()->json(['success' => true]);
    }

    // Helper methods
    protected function getTrendingPosts()
    {
        return Cache::remember('trending_posts', 3600, function () {
            return Blog::trending()
                ->with(['author', 'category'])
                ->limit(5)
                ->get();
        });
    }

    protected function getRelatedPosts(Blog $blog)
    {
        return Cache::remember("related_posts_{$blog->id}", 1800, function () use ($blog) {
            $query = Blog::published()
                ->where('id', '!=', $blog->id)
                ->with(['author', 'category']);

            // First try to find posts in the same category
            if ($blog->category_id) {
                $related = $query->where('category_id', $blog->category_id)->limit(3)->get();
                if ($related->count() >= 3) {
                    return $related;
                }
            }

            // Then try posts with similar tags
            if ($blog->tags->count() > 0) {
                $tagIds = $blog->tags->pluck('id');
                $related = $query->whereHas('tags', function($q) use ($tagIds) {
                    $q->whereIn('blog_tag_id', $tagIds);
                })->limit(3)->get();
                if ($related->count() >= 3) {
                    return $related;
                }
            }

            // Fallback to recent popular posts
            return $query->popular()->limit(3)->get();
        });
    }

    protected function getPopularCategories()
    {
        return Cache::remember('popular_categories', 3600, function () {
            return BlogCategory::active()
                ->withCount('blogs')
                ->having('blogs_count', '>', 0)
                ->orderByDesc('blogs_count')
                ->limit(8)
                ->get();
        });
    }

    protected function getPopularTags()
    {
        return Cache::remember('popular_tags', 3600, function () {
            return BlogTag::withCount('blogs')
                ->having('blogs_count', '>', 0)
                ->orderByDesc('blogs_count')
                ->limit(10)
                ->get();
        });
    }

    protected function getUserEngagement(Blog $blog, Request $request)
    {
        $ip = $request->ip();
        
        return [
            'liked' => Session::has("blog_liked_{$blog->id}_{$ip}"),
            'bookmarked' => Session::has("blog_bookmarked_{$blog->id}_{$ip}"),
            'viewed' => Session::has("blog_viewed_{$blog->id}_{$ip}")
        ];
    }
}