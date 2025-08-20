<?php
// app/Models/Blog.php (Enhanced)

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

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
        'category_id',
        'status',
        'featured',
        'published_at',
        'reading_time',
        'views',
        'likes',
        'shares',
        'bookmarks',
        'saves',
        'meta_title',
        'meta_description',
        'keywords',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'featured' => 'boolean',
        'views' => 'integer',
        'likes' => 'integer',
        'shares' => 'integer',
        'bookmarks' => 'integer',
        'saves' => 'integer',
        'reading_time' => 'integer',
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

    public function scopeTrending($query)
    {
        return $query->published()
                    ->where('created_at', '>=', now()->subDays(7))
                    ->orderByRaw('(views + likes * 5 + shares * 10 + bookmarks * 3) DESC');
    }

    public function scopePopular($query)
    {
        return $query->published()
                    ->orderByDesc('views')
                    ->orderByDesc('likes');
    }

    // Relationships
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(BlogTag::class, 'blog_tag_pivot', 'blog_id', 'blog_tag_id');
    }

    public function analytics()
    {
        return $this->hasMany(BlogAnalytics::class);
    }

    // Mutators
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        if (empty($this->attributes['slug'])) {
            $this->attributes['slug'] = Str::slug($value);
        }
    }

    public function setBodyAttribute($value)
    {
        $this->attributes['body'] = $value;
        // Auto-calculate reading time
        if (!empty($value)) {
            $wordCount = str_word_count(strip_tags($value));
            $this->attributes['reading_time'] = max(1, ceil($wordCount / 200));
        }
    }

    // Accessors
    public function getReadingTimeAttribute($value)
    {
        if ($value) {
            return $value;
        }
        
        $wordCount = str_word_count(strip_tags($this->body));
        return max(1, ceil($wordCount / 200));
    }

    public function getFormattedDateAttribute()
    {
        return $this->published_at ? $this->published_at->format('M d, Y') : $this->created_at->format('M d, Y');
    }

    public function getRelativeDateAttribute()
    {
        return $this->published_at ? $this->published_at->diffForHumans() : $this->created_at->diffForHumans();
    }

    public function getUrlAttribute()
    {
        return route('blog.show', $this->slug);
    }

    public function getFeaturedImageUrlAttribute()
    {
        if ($this->featured_image) {
            return asset('storage/' . $this->featured_image);
        }
        // Return a default image or placeholder
        return asset('images/blog-default.jpg');
    }

    public function getExcerptAttribute($value)
    {
        if ($value) {
            return $value;
        }
        // Auto-generate excerpt from body
        return Str::limit(strip_tags($this->body), 160);
    }

    public function getEngagementScoreAttribute()
    {
        return ($this->views * 1) + ($this->likes * 5) + ($this->shares * 10) + ($this->bookmarks * 3);
    }

    // Helper methods
    public function incrementViews()
    {
        $this->increment('views');
        
        // Track in analytics
        BlogAnalytics::create([
            'blog_id' => $this->id,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'referrer' => request()->header('referer'),
            'event_type' => 'page_view'
        ]);
    }

    public function getEstimatedReadingTime()
    {
        $words = str_word_count(strip_tags($this->body));
        return max(1, ceil($words / 200));
    }
}

// app/Models/BlogCategory.php


// app/Models/BlogTag.php


// app/Models/BlogAnalytics.php
