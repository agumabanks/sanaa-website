<?php

// app/Http/Controllers/BlogController.php
namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogAnalytics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::with(['author', 'tags', 'analytics'])
            ->published()
            ->orderByDesc('featured')
            ->orderByDesc('published_at');

        // Handle infinite scroll AJAX requests
        if ($request->ajax()) {
            $blogs = $query->paginate(6);
            return response()->json([
                'articles' => $blogs->items(),
                'has_more' => $blogs->hasMorePages(),
                'next_page' => $blogs->nextPageUrl()
            ]);
        }

        $blogs = $query->paginate(12);
        $trending = $this->getTrendingPosts();
        $topics = $this->getPopularTopics();

        return view('blog.index', compact('blogs', 'trending', 'topics'));
    }

    public function show(Blog $blog, Request $request)
    {
        // Track page view
        $blog->increment('views');
        
        // Track detailed analytics
        BlogAnalytics::create([
            'blog_id' => $blog->id,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'referrer' => $request->header('referer'),
            'event_type' => 'page_view'
        ]);

        $relatedPosts = $this->getRelatedPosts($blog);
        $readingTime = $this->calculateReadingTime($blog->body);

        // SEO optimizations
        $seoData = [
            'title' => $blog->title . ' | Sanaa Blog',
            'description' => $blog->excerpt,
            'image' => $blog->featured_image ? asset('storage/' . $blog->featured_image) : null,
            'url' => route('blog.show', $blog->slug),
            'published_time' => $blog->published_at->toISOString(),
            'modified_time' => $blog->updated_at->toISOString(),
            'author' => $blog->author->name ?? 'Sanaa Team',
            'reading_time' => $readingTime
        ];

        return view('blog.show', compact('blog', 'relatedPosts', 'seoData', 'readingTime'));
    }

    public function like(Blog $blog, Request $request)
    {
        $ip = $request->ip();
        $sessionKey = "blog_liked_{$blog->id}_{$ip}";
        
        if (!session($sessionKey)) {
            $blog->increment('likes');
            session([$sessionKey => true]);
            
            // Track engagement
            BlogAnalytics::create([
                'blog_id' => $blog->id,
                'ip_address' => $ip,
                'event_type' => 'like'
            ]);
        }

        return response()->json([
            'likes' => $blog->fresh()->likes,
            'liked' => true
        ]);
    }

    public function bookmark(Blog $blog, Request $request)
    {
        $ip = $request->ip();
        $sessionKey = "blog_bookmarked_{$blog->id}_{$ip}";
        
        if (!session($sessionKey)) {
            $blog->increment('bookmarks');
            session([$sessionKey => true]);
            
            BlogAnalytics::create([
                'blog_id' => $blog->id,
                'ip_address' => $ip,
                'event_type' => 'bookmark'
            ]);
        }

        return response()->json([
            'bookmarks' => $blog->fresh()->bookmarks,
            'bookmarked' => true
        ]);
    }

    public function share(Blog $blog, Request $request)
    {
        $blog->increment('shares');
        
        BlogAnalytics::create([
            'blog_id' => $blog->id,
            'ip_address' => $request->ip(),
            'event_type' => 'share',
            'metadata' => $request->only(['platform', 'referrer'])
        ]);

        return response()->json([
            'shares' => $blog->fresh()->shares
        ]);
    }

    public function trackAnalytics(Request $request)
    {
        $validated = $request->validate([
            'event' => 'required|string',
            'data' => 'array',
            'blog_id' => 'sometimes|exists:blogs,id',
            'timestamp' => 'required|integer'
        ]);

        BlogAnalytics::create([
            'blog_id' => $validated['blog_id'] ?? null,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'event_type' => $validated['event'],
            'metadata' => $validated['data'] ?? []
        ]);

        return response()->json(['status' => 'tracked']);
    }

    private function getTrendingPosts()
    {
        return Cache::remember('trending_posts', 3600, function () {
            return Blog::published()
                ->where('published_at', '>=', now()->subDays(7))
                ->orderBy('views', 'desc')
                ->orderBy('likes', 'desc')
                ->take(5)
                ->get();
        });
    }

    private function getPopularTopics()
    {
        return Cache::remember('popular_topics', 3600, function () {
            // This would depend on your tag/category implementation
            return ['Technology', 'Finance', 'Innovation', 'Africa', 'Startups'];
        });
    }

    private function getRelatedPosts(Blog $blog)
    {
        return Blog::published()
            ->where('id', '!=', $blog->id)
            ->where(function($query) use ($blog) {
                // Simple related posts based on tags or category
                if ($blog->tags) {
                    $query->whereHas('tags', function($q) use ($blog) {
                        $q->whereIn('name', $blog->tags->pluck('name'));
                    });
                }
            })
            ->orderBy('views', 'desc')
            ->take(3)
            ->get();
    }

    private function calculateReadingTime($content)
    {
        $wordCount = str_word_count(strip_tags($content));
        $wordsPerMinute = 200; // Average reading speed
        return ceil($wordCount / $wordsPerMinute);
    }
}

// app/Models/Blog.php (Enhanced)
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'featured_image',
        'author_id',
        'status',
        'featured',
        'published_at',
        'reading_time',
        'views',
        'likes',
        'shares',
        'bookmarks'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'featured' => 'boolean',
        'views' => 'integer',
        'likes' => 'integer',
        'shares' => 'integer',
        'bookmarks' => 'integer'
    ];

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    // Relationships
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function analytics()
    {
        return $this->hasMany(BlogAnalytics::class);
    }

    // Mutators
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // Accessors
    public function getReadingTimeAttribute()
    {
        if ($this->attributes['reading_time']) {
            return $this->attributes['reading_time'];
        }
        
        $wordCount = str_word_count(strip_tags($this->body));
        return ceil($wordCount / 200);
    }

    public function getFormattedDateAttribute()
    {
        return $this->published_at ? $this->published_at->format('M d, Y') : null;
    }

    public function getUrlAttribute()
    {
        return route('blog.show', $this->slug);
    }
}

// app/Models/BlogAnalytics.php (New)
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogAnalytics extends Model
{
    protected $fillable = [
        'blog_id',
        'ip_address',
        'user_agent',
        'referrer',
        'event_type',
        'metadata'
    ];

    protected $casts = [
        'metadata' => 'array'
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}

// database/migrations/xxxx_enhance_blogs_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EnhanceBlogsTable extends Migration
{
    public function up()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->string('featured_image')->nullable()->after('body');
            $table->unsignedBigInteger('author_id')->nullable()->after('featured_image');
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft')->after('author_id');
            $table->boolean('featured')->default(false)->after('status');
            $table->timestamp('published_at')->nullable()->after('featured');
            $table->integer('reading_time')->nullable()->after('published_at');
            $table->integer('views')->default(0)->after('reading_time');
            $table->integer('likes')->default(0)->after('views');
            $table->integer('shares')->default(0)->after('likes');
            $table->integer('bookmarks')->default(0)->after('shares');
            
            $table->foreign('author_id')->references('id')->on('users')->onDelete('set null');
            $table->index(['status', 'published_at']);
            $table->index(['featured', 'published_at']);
        });
    }

    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropColumn([
                'featured_image', 'author_id', 'status', 'featured',
                'published_at', 'reading_time', 'views', 'likes',
                'shares', 'bookmarks'
            ]);
        });
    }
}

// database/migrations/xxxx_create_blog_analytics_table.php
class CreateBlogAnalyticsTable extends Migration
{
    public function up()
    {
        Schema::create('blog_analytics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blog_id')->nullable();
            $table->string('ip_address', 45);
            $table->text('user_agent')->nullable();
            $table->string('referrer')->nullable();
            $table->string('event_type');
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
            $table->index(['blog_id', 'event_type']);
            $table->index(['created_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('blog_analytics');
    }
}