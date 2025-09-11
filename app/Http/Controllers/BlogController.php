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
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Toggle publish status (admin only)
     */
    public function toggleStatus(\App\Models\Blog $blog)
    {
        // Route is protected by 'admin' middleware; additionally ensure capability
        $this->authorize('update', $blog);

        if ($blog->status === 'published') {
            $blog->update([
                'status' => 'draft',
            ]);
            return back()->with('success', 'Post unpublished');
        }

        $data = ['status' => 'published'];
        if (!$blog->published_at) {
            $data['published_at'] = now();
        }
        $blog->update($data);

        return back()->with('success', 'Post published');
    }
    public function index(Request $request)
    {
        $query = Blog::with(['author', 'category', 'tags'])
            ->published()
            ->orderByDesc('featured')
            ->orderByRaw('COALESCE(published_at, created_at) DESC')
            ->orderByDesc('created_at');

        // Blog index is public: always show published posts to everyone

        // Featured filter
        if ($request->boolean('featured')) {
            $query->featured();
        }

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

        // SEO for index page
        $seoData = [
            'title' => 'Sanaa Co. Blog — Ideas on Technology, Design, and Innovation',
            'description' => 'Discover minimalist insights and profound thoughts on technology, design, and innovation from the Sanaa team.',
            'url' => route('blog.index'),
            'image' => \cdn_asset('storage/images/sanaa.png'),
        ];

        return view('blog.index', compact('blogs', 'featuredPost', 'trendingPosts', 'categories', 'tags', 'seoData'));
    }

    public function category(BlogCategory $category, Request $request)
    {
        // Reuse index() with category filter
        $request->merge(['category' => $category->slug]);
        return $this->index($request);
    }

    public function tag(BlogTag $tag, Request $request)
    {
        // Reuse index() with tag filter
        $request->merge(['tag' => $tag->slug]);
        return $this->index($request);
    }

    public function show(Blog $blog, Request $request)
    {
        // Only allow public access to published posts; admins can preview drafts/scheduled
        $isPublishedNow = $blog->status === 'published' && (! $blog->published_at || $blog->published_at <= now());
        if (! $isPublishedNow) {
            if (!(auth()->check() && auth()->user()->isAdmin())) {
                abort(404);
            }
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
        // Block interactions on unpublished posts
        $isPublishedNow = $blog->status === 'published' && (! $blog->published_at || $blog->published_at <= now());
        abort_unless($isPublishedNow, 404);
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
        // Block interactions on unpublished posts
        $isPublishedNow = $blog->status === 'published' && (! $blog->published_at || $blog->published_at <= now());
        abort_unless($isPublishedNow, 404);
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

            // If authenticated, add to user's library
            if (auth()->check()) {
                $user = auth()->user();
                if (!$blog->savers()->where('user_id', $user->id)->exists()) {
                    $blog->savers()->attach($user->id);
                }
            }

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
        // Block interactions on unpublished posts
        $isPublishedNow = $blog->status === 'published' && (! $blog->published_at || $blog->published_at <= now());
        abort_unless($isPublishedNow, 404);
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

    public function comment(Blog $blog, Request $request)
    {
        // Block interactions on unpublished posts
        $isPublishedNow = $blog->status === 'published' && (! $blog->published_at || $blog->published_at <= now());
        abort_unless($isPublishedNow, 404);
        $validated = $request->validate([
            'body' => 'required|string|min:3',
            'parent_id' => 'nullable|exists:blog_comments,id'
        ]);

        $data = [
            'blog_id' => $blog->id,
            'body' => $validated['body'],
            'parent_id' => $validated['parent_id'] ?? null,
            'status' => 'approved',
        ];

        if (auth()->check()) {
            $data['user_id'] = auth()->id();
            $data['name'] = auth()->user()->name;
            $data['email'] = auth()->user()->email;
        } else {
            $guest = $request->validate([
                'name' => 'nullable|string|max:100',
                'email' => 'nullable|email|max:150',
            ]);
            $data['name'] = $guest['name'] ?? null;
            $data['email'] = $guest['email'] ?? null;
        }

        \App\Models\BlogComment::create($data);

        return back()->with('success', 'Comment posted');
    }

    public function forYou(Request $request)
    {
        abort_unless(auth()->check(), 403);

        $user = auth()->user();
        $authorIds = $user->following()->pluck('users.id')->toArray();
        $categoryIds = $user->followedCategories()->pluck('blog_categories.id')->toArray();
        $tagIds = $user->followedTags()->pluck('blog_tags.id')->toArray();

        $query = Blog::with(['author','category','tags'])
            ->published()
            ->when($authorIds, fn($q) => $q->whereIn('author_id', $authorIds))
            ->orWhere(function($q) use ($categoryIds) {
                if ($categoryIds) $q->whereIn('category_id', $categoryIds);
            })
            ->orWhere(function($q) use ($tagIds) {
                if ($tagIds) {
                    $q->whereHas('tags', fn($t) => $t->whereIn('blog_tag_id', $tagIds));
                }
            })
            ->orderByRaw('COALESCE(published_at, created_at) DESC');

        $blogs = $query->paginate(12);
        $featuredPost = Blog::published()->featured()->first();
        $trendingPosts = $this->getTrendingPosts();
        $categories = $this->getPopularCategories();
        $tags = $this->getPopularTags();

        $seoData = [
            'title' => 'For You — Personalized Stories',
            'description' => 'Stories from authors, topics, and publications you follow.',
            'url' => route('blog.for-you'),
            'image' => \cdn_asset('storage/images/sanaa.png'),
        ];

        return view('blog.index', compact('blogs','featuredPost','trendingPosts','categories','tags','seoData'));
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
    public function getTrendingPosts()
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

    public function store(Request $request)
    {
        $this->authorize('create', Blog::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug',
            'excerpt' => 'nullable|string|max:500',
            'body' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'author_id' => 'nullable|exists:users,id',
            'category_id' => 'nullable|exists:blog_categories,id',
            'status' => 'required|in:draft,published',
            'featured' => 'boolean',
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:160',
            'keywords' => 'nullable|string|max:255',
        ]);

        // Set author_id to current user if not provided
        if (!isset($validated['author_id'])) {
            $validated['author_id'] = auth()->id();
        }

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('blogs', 'public');
        }

        $blog = Blog::create($validated);

        if (auth()->user()?->isAdmin()) {
            return redirect()->route('dashboard.blog')->with('success', 'Blog post created successfully');
        }
        return redirect()->route('dashboard.my-posts')->with('success', 'Story created successfully');
    }

    public function update(Request $request, Blog $blog)
    {
        $this->authorize('update', $blog);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug,' . $blog->id,
            'excerpt' => 'nullable|string|max:500',
            'body' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'author_id' => 'nullable|exists:users,id',
            'category_id' => 'nullable|exists:blog_categories,id',
            'status' => 'required|in:draft,published',
            'featured' => 'boolean',
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:160',
            'keywords' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($blog->featured_image) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('blogs', 'public');
        }

        $blog->update($validated);

        return redirect()->route('dashboard.blog')->with('success', 'Blog post updated successfully');
    }

    public function destroy(Blog $blog)
    {
        $this->authorize('delete', $blog);

        // Delete featured image if exists
        if ($blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
        }

        $blog->delete();

        return redirect()->route('dashboard.blog')->with('success', 'Blog post deleted successfully');
    }
}
