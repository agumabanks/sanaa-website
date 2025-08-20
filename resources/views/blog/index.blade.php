{{-- resources/views/blog/index.blade.php --}}
@extends('layouts.landing')

@section('title', 'Blog | ' . config('app.name'))

@push('meta')
    <meta name="description" content="Insights on digital infrastructure, fintech, and innovation across Africa from the Sanaa team.">
    <meta property="og:title" content="Sanaa Blog - Digital Infrastructure Insights">
    <meta property="og:description" content="Insights on digital infrastructure, fintech, and innovation across Africa">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ route('blog.index') }}">
@endpush

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Charter:ital,wght@0,400;0,700;1,400;1,700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    /* Steve Jobs-inspired minimalist design with dark monochrome theme */
    :root {
        --primary-black: #000000;
        --secondary-black: #1a1a1a;
        --tertiary-black: #2a2a2a;
        --text-primary: #ffffff;
        --text-secondary: #b3b3b3;
        --text-tertiary: #808080;
        --accent-green: #00ff00;
        --border-color: #333333;
        --hover-bg: #1a1a1a;
        --reading-width: 680px;
    }

    body {
        background-color: var(--primary-black);
        color: var(--text-primary);
    }

    .font-charter { font-family: 'Charter', Georgia, serif; }
    .font-inter { font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; }

    .blog-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 48px 24px;
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 64px;
    }

    .blog-title {
        font-size: 42px;
        font-weight: 700;
        margin-bottom: 48px;
        letter-spacing: -0.03em;
        font-family: 'Inter', sans-serif;
        color: var(--text-primary);
    }

    .article-card {
        display: flex;
        gap: 24px;
        padding: 32px 0;
        border-bottom: 1px solid var(--border-color);
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        color: inherit;
    }

    .article-card:hover {
        transform: translateY(-2px);
        text-decoration: none;
        color: inherit;
    }

    .article-content {
        flex: 1;
    }

    .article-meta {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
        font-family: 'Inter', sans-serif;
        font-size: 13px;
        color: var(--text-tertiary);
    }

    .author-avatar {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: var(--tertiary-black);
    }

    .article-title {
        font-size: 24px;
        font-weight: 700;
        line-height: 1.2;
        margin-bottom: 8px;
        color: var(--text-primary);
        font-family: 'Charter', serif;
    }

    .article-excerpt {
        font-size: 16px;
        color: var(--text-secondary);
        line-height: 1.5;
        margin-bottom: 16px;
    }

    .article-engagement {
        display: flex;
        align-items: center;
        gap: 24px;
        font-family: 'Inter', sans-serif;
        font-size: 13px;
        color: var(--text-tertiary);
    }

    .engagement-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .article-image {
        width: 160px;
        height: 120px;
        border-radius: 4px;
        object-fit: cover;
        background: var(--secondary-black);
    }

    .sidebar {
        padding-top: 32px;
    }

    .sidebar-section {
        background: var(--secondary-black);
        border-radius: 8px;
        padding: 24px;
        margin-bottom: 32px;
    }

    .sidebar-title {
        font-family: 'Inter', sans-serif;
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 16px;
        color: var(--text-primary);
    }

    .trending-item {
        display: flex;
        gap: 12px;
        margin-bottom: 16px;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--border-color);
    }

    .trending-number {
        font-family: 'Inter', sans-serif;
        font-size: 24px;
        font-weight: 700;
        color: var(--text-tertiary);
        width: 32px;
    }

    .trending-content h4 {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 4px;
        color: var(--text-primary);
    }

    .trending-meta {
        font-family: 'Inter', sans-serif;
        font-size: 12px;
        color: var(--text-tertiary);
    }

    .topic-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .topic-tag {
        background: var(--tertiary-black);
        padding: 6px 12px;
        border-radius: 16px;
        font-size: 13px;
        color: var(--text-secondary);
        text-decoration: none;
        transition: background-color 0.2s ease;
    }

    .topic-tag:hover {
        background: var(--hover-bg);
        color: var(--text-primary);
    }

    .load-more {
        text-align: center;
        margin-top: 48px;
    }

    .load-more-btn {
        background: var(--text-primary);
        color: var(--primary-black);
        padding: 12px 24px;
        border-radius: 24px;
        font-size: 14px;
        font-weight: 500;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .load-more-btn:hover {
        background: var(--text-secondary);
        transform: translateY(-1px);
    }

    .featured-badge {
        background: var(--accent-green);
        color: var(--primary-black);
        font-size: 10px;
        font-weight: 600;
        padding: 4px 8px;
        border-radius: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    @media (max-width: 1024px) {
        .blog-container {
            grid-template-columns: 1fr;
            gap: 48px;
        }
        
        .sidebar {
            order: -1;
        }
    }

    @media (max-width: 768px) {
        .article-card {
            flex-direction: column;
            gap: 16px;
        }
        
        .article-image {
            width: 100%;
            height: 200px;
            order: -1;
        }
        
        .blog-title {
            font-size: 36px;
        }
    }
</style>
@endpush

@section('content')
<div class="blog-container">
    <div class="articles-section">
        <h1 class="blog-title">Latest Stories</h1>
        
        <div id="articles-container">
            @foreach($blogs as $blog)
                <article class="article-card" data-aos="fade-up">
                    <div class="article-content">
                        <div class="article-meta">
                            <div class="author-avatar" style="background-image: url('{{ $blog->author->avatar ?? '' }}')"></div>
                            <span>{{ $blog->author->name ?? 'Sanaa Team' }}</span>
                            <span>•</span>
                            <span>{{ $blog->formatted_date }}</span>
                            <span>•</span>
                            <span>{{ $blog->reading_time }} min read</span>
                            @if($blog->featured)
                                <span class="featured-badge">Featured</span>
                            @endif
                        </div>
                        <h2 class="article-title">
                            <a href="{{ route('blog.show', $blog->slug) }}" style="color: inherit; text-decoration: none;">
                                {{ $blog->title }}
                            </a>
                        </h2>
                        <p class="article-excerpt">{{ $blog->excerpt }}</p>
                        <div class="article-engagement">
                            <div class="engagement-item">
                                <span>👏</span>
                                <span>{{ $blog->likes }}</span>
                            </div>
                            <div class="engagement-item">
                                <span>💬</span>
                                <span>{{ $blog->comments_count ?? 0 }}</span>
                            </div>
                            <div class="engagement-item">
                                <span>🔖</span>
                                <span>{{ $blog->bookmarks }}</span>
                            </div>
                            <div class="engagement-item">
                                <span>{{ $blog->views }} views</span>
                            </div>
                        </div>
                    </div>
                    @if($blog->featured_image)
                        <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="article-image">
                    @else
                        <div class="article-image" style="background: var(--secondary-black); display: flex; align-items: center; justify-content: center; color: var(--text-tertiary);">
                            📖
                        </div>
                    @endif
                </article>
            @endforeach
        </div>

        @if($blogs->hasMorePages())
            <div class="load-more">
                <button class="load-more-btn" id="load-more-btn">Load More Stories</button>
            </div>
        @endif
    </div>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-section">
            <h3 class="sidebar-title">Trending on Sanaa</h3>
            @foreach($trending as $index => $post)
                <div class="trending-item">
                    <span class="trending-number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    <div class="trending-content">
                        <h4>
                            <a href="{{ route('blog.show', $post->slug) }}" style="color: inherit; text-decoration: none;">
                                {{ $post->title }}
                            </a>
                        </h4>
                        <p class="trending-meta">{{ $post->author->name ?? 'Sanaa Team' }} • {{ number_format($post->views) }} reads</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="sidebar-section">
            <h3 class="sidebar-title">Topics</h3>
            <div class="topic-tags">
                @foreach($topics as $topic)
                    <a href="{{ route('blog.index', ['topic' => strtolower($topic)]) }}" class="topic-tag">{{ $topic }}</a>
                @endforeach
            </div>
        </div>

        <div class="sidebar-section">
            <h3 class="sidebar-title">About Sanaa</h3>
            <p style="font-size: 14px; line-height: 1.5; color: var(--text-secondary);">
                Building digital infrastructure across Africa. From e-commerce to fintech, we're creating technology that works for everyone.
            </p>
        </div>
    </aside>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Infinite scroll functionality
    let loading = false;
    let currentPage = {{ $blogs->currentPage() }};
    const loadMoreBtn = document.getElementById('load-more-btn');
    
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', loadMoreArticles);
    }

    function loadMoreArticles() {
        if (loading) return;
        
        loading = true;
        loadMoreBtn.textContent = 'Loading...';
        
        fetch(`{{ route('blog.index') }}?page=${currentPage + 1}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.articles && data.articles.length > 0) {
                const container = document.getElementById('articles-container');
                
                data.articles.forEach(article => {
                    const articleElement = createArticleElement(article);
                    container.appendChild(articleElement);
                });
                
                currentPage++;
                
                if (!data.has_more) {
                    loadMoreBtn.style.display = 'none';
                }
            }
        })
        .catch(error => {
            console.error('Error loading more articles:', error);
        })
        .finally(() => {
            loading = false;
            loadMoreBtn.textContent = 'Load More Stories';
        });
    }

    function createArticleElement(article) {
        const articleDiv = document.createElement('article');
        articleDiv.className = 'article-card';
        articleDiv.innerHTML = `
            <div class="article-content">
                <div class="article-meta">
                    <div class="author-avatar"></div>
                    <span>${article.author?.name || 'Sanaa Team'}</span>
                    <span>•</span>
                    <span>${formatDate(article.published_at)}</span>
                    <span>•</span>
                    <span>${article.reading_time} min read</span>
                    ${article.featured ? '<span class="featured-badge">Featured</span>' : ''}
                </div>
                <h2 class="article-title">
                    <a href="/blog/${article.slug}" style="color: inherit; text-decoration: none;">
                        ${article.title}
                    </a>
                </h2>
                <p class="article-excerpt">${article.excerpt}</p>
                <div class="article-engagement">
                    <div class="engagement-item">
                        <span>👏</span>
                        <span>${article.likes}</span>
                    </div>
                    <div class="engagement-item">
                        <span>💬</span>
                        <span>0</span>
                    </div>
                    <div class="engagement-item">
                        <span>🔖</span>
                        <span>${article.bookmarks}</span>
                    </div>
                    <div class="engagement-item">
                        <span>${article.views} views</span>
                    </div>
                </div>
            </div>
            ${article.featured_image ? 
                `<img src="/storage/${article.featured_image}" alt="${article.title}" class="article-image">` :
                '<div class="article-image" style="background: var(--secondary-black); display: flex; align-items: center; justify-content: center; color: var(--text-tertiary);">📖</div>'
            }
        `;
        return articleDiv;
    }

    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
    }

    // Add smooth scroll animations
    const articles = document.querySelectorAll('.article-card');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    });

    articles.forEach(article => {
        article.style.opacity = '0';
        article.style.transform = 'translateY(20px)';
        article.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(article);
    });
});
</script>
@endpush

{{-- resources/views/blog/show.blade.php --}}
@extends('layouts.landing')

@section('title', $seoData['title'])

@push('meta')
    <meta name="description" content="{{ $seoData['description'] }}">
    <meta name="author" content="{{ $seoData['author'] }}">
    
    <!-- Open Graph -->
    <meta property="og:title" content="{{ $seoData['title'] }}">
    <meta property="og:description" content="{{ $seoData['description'] }}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ $seoData['url'] }}">
    @if($seoData['image'])
        <meta property="og:image" content="{{ $seoData['image'] }}">
    @endif
    <meta property="article:published_time" content="{{ $seoData['published_time'] }}">
    <meta property="article:modified_time" content="{{ $seoData['modified_time'] }}">
    <meta property="article:author" content="{{ $seoData['author'] }}">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoData['title'] }}">
    <meta name="twitter:description" content="{{ $seoData['description'] }}">
    @if($seoData['image'])
        <meta name="twitter:image" content="{{ $seoData['image'] }}">
    @endif
    
    <!-- Reading Progress -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Charter:ital,wght@0,400;0,700;1,400;1,700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    :root {
        --primary-black: #000000;
        --secondary-black: #1a1a1a;
        --tertiary-black: #2a2a2a;
        --text-primary: #ffffff;
        --text-secondary: #b3b3b3;
        --text-tertiary: #808080;
        --accent-green: #00ff00;
        --border-color: #333333;
        --hover-bg: #1a1a1a;
        --reading-width: 680px;
    }

    body {
        background-color: var(--primary-black);
        color: var(--text-primary);
    }

    .font-charter { font-family: 'Charter', Georgia, serif; }
    .font-inter { font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; }

    .reading-progress {
        position: fixed;
        top: 0;
        left: 0;
        height: 3px;
        background: var(--accent-green);
        z-index: 1001;
        transition: width 0.1s ease;
        width: 0%;
    }

    .reading-view {
        max-width: var(--reading-width);
        margin: 0 auto;
        padding: 48px 24px;
    }

    .article-header {
        margin-bottom: 48px;
    }

    .article-header h1 {
        font-size: 48px;
        font-weight: 700;
        line-height: 1.1;
        margin-bottom: 24px;
        letter-spacing: -0.03em;
        font-family: 'Charter', serif;
        color: var(--text-primary);
    }

    .article-subtitle {
        font-size: 20px;
        color: var(--text-secondary);
        margin-bottom: 32px;
        line-height: 1.4;
        font-style: italic;
    }

    .article-author-section {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 32px;
    }

    .author-avatar-large {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: var(--tertiary-black);
    }

    .author-info h3 {
        font-family: 'Inter', sans-serif;
        font-size: 16px;
        font-weight: 500;
        margin-bottom: 4px;
        color: var(--text-primary);
    }

    .author-meta {
        font-family: 'Inter', sans-serif;
        font-size: 14px;
        color: var(--text-tertiary);
    }

    .article-actions {
        display: flex;
        align-items: center;
        gap: 24px;
        padding: 16px 0;
        border-top: 1px solid var(--border-color);
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 32px;
    }

    .action-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        background: none;
        border: none;
        color: var(--text-tertiary);
        font-family: 'Inter', sans-serif;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s ease;
        padding: 8px 12px;
        border-radius: 20px;
    }

    .action-btn:hover {
        background: var(--hover-bg);
        color: var(--text-secondary);
    }

    .action-btn.active {
        color: var(--accent-green);
    }

    .article-featured-image {
        width: 100%;
        max-height: 400px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 32px;
    }

    .article-body {
        font-size: 20px;
        line-height: 1.7;
        color: var(--text-primary);
        font-family: 'Charter', serif;
    }

    .article-body p {
        margin-bottom: 24px;
    }

    .article-body h2 {
        font-size: 32px;
        font-weight: 700;
        margin: 48px 0 24px 0;
        color: var(--text-primary);
        font-family: 'Charter', serif;
    }

    .article-body h3 {
        font-size: 24px;
        font-weight: 600;
        margin: 32px 0 16px 0;
        color: var(--text-primary);
        font-family: 'Charter', serif;
    }

    .article-body blockquote {
        border-left: 4px solid var(--text-primary);
        padding-left: 24px;
        margin: 32px 0;
        font-style: italic;
        font-size: 22px;
        color: var(--text-secondary);
    }

    .article-body img {
        width: 100%;
        border-radius: 8px;
        margin: 32px 0;
    }

    .article-body ul, .article-body ol {
        margin: 24px 0;
        padding-left: 24px;
    }

    .article-body li {
        margin-bottom: 8px;
    }

    .article-footer {
        margin-top: 64px;
        padding-top: 32px;
        border-top: 1px solid var(--border-color);
    }

    .related-posts {
        margin-top: 64px;
    }

    .related-posts h3 {
        font-family: 'Inter', sans-serif;
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 32px;
        color: var(--text-primary);
    }

    .related-post {
        display: flex;
        gap: 16px;
        padding: 16px 0;
        border-bottom: 1px solid var(--border-color);
        text-decoration: none;
        color: inherit;
        transition: opacity 0.2s ease;
    }

    .related-post:hover {
        opacity: 0.8;
        text-decoration: none;
        color: inherit;
    }

    .related-post-image {
        width: 80px;
        height: 60px;
        border-radius: 4px;
        object-fit: cover;
        background: var(--secondary-black);
    }

    .related-post-content h4 {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 4px;
        color: var(--text-primary);
    }

    .related-post-meta {
        font-family: 'Inter', sans-serif;
        font-size: 12px;
        color: var(--text-tertiary);
    }

    .reading-controls {
        position: fixed;
        right: 24px;
        top: 50%;
        transform: translateY(-50%);
        background: var(--secondary-black);
        border-radius: 8px;
        padding: 16px;
        display: none;
        flex-direction: column;
        gap: 8px;
        z-index: 1000;
    }

    .reading-controls button {
        background: none;
        border: 1px solid var(--border-color);
        color: var(--text-secondary);
        padding: 8px;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .reading-controls button:hover {
        background: var(--hover-bg);
        color: var(--text-primary);
    }

    .speak-btn {
        position: fixed;
        bottom: 24px;
        right: 24px;
        background: var(--secondary-black);
        border: 1px solid var(--border-color);
        color: var(--text-secondary);
        width: 48px;
        height: 48px;
        border-radius: 50%;
        cursor: pointer;
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 1001;
        transition: all 0.2s ease;
    }

    .speak-btn:hover {
        background: var(--hover-bg);
        color: var(--text-primary);
    }

    @media (max-width: 768px) {
        .article-header h1 {
            font-size: 36px;
        }
        
        .reading-view {
            padding: 24px 16px;
        }

        .article-actions {
            flex-wrap: wrap;
            gap: 16px;
        }

        .reading-controls {
            display: none !important;
        }
    }
</style>
@endpush

@section('content')
<div class="reading-progress" id="reading-progress"></div>

<article class="reading-view">
    <header class="article-header">
        <h1>{{ $blog->title }}</h1>
        
        @if($blog->excerpt)
            <p class="article-subtitle">{{ $blog->excerpt }}</p>
        @endif
        
        <div class="article-author-section">
            <div class="author-avatar-large" style="background-image: url('{{ $blog->author->avatar ?? '' }}')"></div>
            <div class="author-info">
                <h3>{{ $blog->author->name ?? 'Sanaa Team' }}</h3>
                <p class="author-meta">
                    {{ $blog->formatted_date }} • {{ $readingTime }} min read
                </p>
            </div>
        </div>

        <div class="article-actions">
            <button class="action-btn" data-action="like" data-blog-id="{{ $blog->id }}">
                <span>👏</span>
                <span id="likes-count">{{ $blog->likes }}</span>
            </button>
            <button class="action-btn" data-action="bookmark" data-blog-id="{{ $blog->id }}">
                <span>🔖</span>
                <span id="bookmark-text">Save</span>
            </button>
            <button class="action-btn" data-action="share">
                <span>📤</span>
                <span>Share</span>
            </button>
            <div class="action-btn">
                <span>👁</span>
                <span>{{ number_format($blog->views) }}</span>
            </div>
        </div>
    </header>

    @if($blog->featured_image)
        <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="article-featured-image">
    @endif

    <div class="article-body" id="article-body">
        {!! Illuminate\Support\Str::markdown($blog->body) !!}
    </div>

    <footer class="article-footer">
        <div class="article-actions">
            <button class="action-btn" data-action="like" data-blog-id="{{ $blog->id }}">
                <span>👏</span>
                <span>{{ $blog->likes }}</span>
            </button>
            <button class="action-btn" data-action="bookmark" data-blog-id="{{ $blog->id }}">
                <span>🔖</span>
                <span>Save</span>
            </button>
            <button class="action-btn" data-action="share">
                <span>📤</span>
                <span>Share</span>
            </button>
        </div>
    </footer>

    @if($relatedPosts->count() > 0)
        <section class="related-posts">
            <h3>More from Sanaa</h3>
            @foreach($relatedPosts as $relatedPost)
                <a href="{{ route('blog.show', $relatedPost->slug) }}" class="related-post">
                    @if($relatedPost->featured_image)
                        <img src="{{ asset('storage/' . $relatedPost->featured_image) }}" alt="{{ $relatedPost->title }}" class="related-post-image">
                    @else
                        <div class="related-post-image"></div>
                    @endif
                    <div class="related-post-content">
                        <h4>{{ $relatedPost->title }}</h4>
                        <p class="related-post-meta">{{ $relatedPost->formatted_date }} • {{ $relatedPost->reading_time }} min read</p>
                    </div>
                </a>
            @endforeach
        </section>
    @endif
</article>

<!-- Reading Controls -->
<div class="reading-controls" id="reading-controls">
    <button onclick="adjustFontSize('increase')" title="Increase font size">A+</button>
    <button onclick="adjustFontSize('decrease')" title="Decrease font size">A-</button>
    <button onclick="toggleContrast()" title="Toggle contrast">◐</button>
</div>

<!-- Text-to-Speech Button -->
<button class="speak-btn" id="speak-btn" title="Listen to article">🔊</button>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Advanced blog functionality
    const blogSystem = new SanaaBlogReader();
    
    class SanaaBlogReader {
        constructor() {
            this.blogId = {{ $blog->id }};
            this.startTime = Date.now();
            this.maxScroll = 0;
            this.init();
        }

        init() {
            this.setupReadingProgress();
            this.setupActionButtons();
            this.setupAnalytics();
            this.setupKeyboardShortcuts();
            this.setupReadingEnhancements();
            this.setupTextToSpeech();
        }

        setupReadingProgress() {
            const progressBar = document.getElementById('reading-progress');
            
            window.addEventListener('scroll', () => {
                const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
                const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                const scrolled = (winScroll / height) * 100;
                
                progressBar.style.width = scrolled + '%';
                
                // Track max scroll for analytics
                if (scrolled > this.maxScroll) {
                    this.maxScroll = scrolled;
                    this.trackEvent('scroll_progress', { percent: Math.round(scrolled) });
                }
            });
        }

        setupActionButtons() {
            document.querySelectorAll('[data-action]').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.handleAction(btn.dataset.action, btn);
                });
            });
        }

        async handleAction(action, btn) {
            const blogId = btn.dataset.blogId;
            
            try {
                switch(action) {
                    case 'like':
                        const likeResponse = await this.apiCall(`/api/blogs/${blogId}/like`, 'POST');
                        document.getElementById('likes-count').textContent = likeResponse.likes;
                        btn.classList.add('active');
                        this.trackEvent('like');
                        break;
                        
                    case 'bookmark':
                        const bookmarkResponse = await this.apiCall(`/api/blogs/${blogId}/bookmark`, 'POST');
                        document.getElementById('bookmark-text').textContent = 'Saved';
                        btn.classList.add('active');
                        this.trackEvent('bookmark');
                        break;
                        
                    case 'share':
                        if (navigator.share) {
                            await navigator.share({
                                title: '{{ $blog->title }}',
                                text: '{{ $blog->excerpt }}',
                                url: window.location.href
                            });
                        } else {
                            await navigator.clipboard.writeText(window.location.href);
                            this.showToast('Link copied to clipboard');
                        }
                        
                        await this.apiCall(`/api/blogs/${blogId}/share`, 'POST');
                        this.trackEvent('share');
                        break;
                }
            } catch (error) {
                console.error('Action failed:', error);
                this.showToast('Action failed. Please try again.');
            }
        }

        async apiCall(url, method = 'GET', data = null) {
            const options = {
                method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            };
            
            if (data) {
                options.body = JSON.stringify(data);
            }
            
            const response = await fetch(url, options);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            return response.json();
        }

        setupAnalytics() {
            // Track reading time when user leaves
            document.addEventListener('visibilitychange', () => {
                if (document.hidden) {
                    const timeSpent = Date.now() - this.startTime;
                    this.trackEvent('reading_time', { duration: timeSpent });
                } else {
                    this.startTime = Date.now();
                }
            });

            // Track when user finishes reading
            window.addEventListener('beforeunload', () => {
                const timeSpent = Date.now() - this.startTime;
                this.trackEvent('session_end', { 
                    duration: timeSpent, 
                    maxScroll: this.maxScroll 
                });
            });
        }

        setupKeyboardShortcuts() {
            document.addEventListener('keydown', (e) => {
                if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') return;
                
                switch(e.key) {
                    case 'l':
                        document.querySelector('[data-action="like"]')?.click();
                        break;
                    case 's':
                        document.querySelector('[data-action="bookmark"]')?.click();
                        break;
                    case 'Escape':
                        window.history.back();
                        break;
                }
            });
        }

        setupReadingEnhancements() {
            // Show reading controls on scroll
            let scrollTimeout;
            window.addEventListener('scroll', () => {
                const controls = document.getElementById('reading-controls');
                controls.style.display = 'flex';
                
                clearTimeout(scrollTimeout);
                scrollTimeout = setTimeout(() => {
                    controls.style.display = 'none';
                }, 3000);
            });
        }

        setupTextToSpeech() {
            if ('speechSynthesis' in window) {
                const speakBtn = document.getElementById('speak-btn');
                speakBtn.style.display = 'flex';
                
                speakBtn.addEventListener('click', () => {
                    const text = document.getElementById('article-body').textContent;
                    const utterance = new SpeechSynthesisUtterance(text);
                    utterance.rate = 0.8;
                    utterance.pitch = 1;
                    
                    if (speechSynthesis.speaking) {
                        speechSynthesis.cancel();
                        speakBtn.textContent = '🔊';
                    } else {
                        speechSynthesis.speak(utterance);
                        speakBtn.textContent = '⏸';
                        this.trackEvent('text_to_speech_start');
                    }
                    
                    utterance.onend = () => {
                        speakBtn.textContent = '🔊';
                        this.trackEvent('text_to_speech_complete');
                    };
                });
            }
        }

        async trackEvent(eventName, data = {}) {
            try {
                await this.apiCall('/api/analytics/track', 'POST', {
                    event: eventName,
                    data: data,
                    blog_id: this.blogId,
                    timestamp: Date.now()
                });
            } catch (error) {
                console.error('Analytics tracking failed:', error);
            }
        }

        showToast(message) {
            const toast = document.createElement('div');
            toast.style.cssText = `
                position: fixed;
                bottom: 24px;
                left: 50%;
                transform: translateX(-50%);
                background: var(--text-primary);
                color: var(--primary-black);
                padding: 12px 24px;
                border-radius: 24px;
                font-size: 14px;
                z-index: 1002;
                opacity: 0;
                transition: opacity 0.3s ease;
            `;
            toast.textContent = message;
            document.body.appendChild(toast);
            
            setTimeout(() => toast.style.opacity = '1', 100);
            setTimeout(() => {
                toast.style.opacity = '0';
                setTimeout(() => document.body.removeChild(toast), 300);
            }, 3000);
        }
    }
});

// Reading enhancement functions
function adjustFontSize(action) {
    const articleBody = document.getElementById('article-body');
    const currentSize = window.getComputedStyle(articleBody).fontSize;
    const size = parseInt(currentSize);
    
    if (action === 'increase' && size < 28) {
        articleBody.style.fontSize = (size + 2) + 'px';
    } else if (action === 'decrease' && size > 16) {
        articleBody.style.fontSize = (size - 2) + 'px';
    }
}

function toggleContrast() {
    document.body.classList.toggle('high-contrast');
}
</script>
@endpush

{{-- resources/views/layouts/blog.blade.php (Optional dedicated blog layout) --}}
@extends('layouts.landing')

@section('body_class', 'blog-layout')

@push('styles')
<style>
    .blog-layout {
        background-color: #000000;
        color: #ffffff;
        font-family: 'Charter', Georgia, serif;
    }
    
    .blog-nav {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.95);
        backdrop-filter: blur(20px);
        border-bottom: 1px solid #333333;
        z-index: 1000;
        padding: 16px 0;
    }
    
    .blog-nav-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .blog-logo {
        font-family: 'Inter', sans-serif;
        font-size: 24px;
        font-weight: 700;
        color: #ffffff;
        text-decoration: none;
        letter-spacing: -0.02em;
    }
    
    .blog-nav-menu {
        display: flex;
        list-style: none;
        gap: 32px;
        align-items: center;
        margin: 0;
        padding: 0;
    }
    
    .blog-nav-link {
        color: #b3b3b3;
        text-decoration: none;
        font-family: 'Inter', sans-serif;
        font-size: 14px;
        font-weight: 400;
        transition: color 0.2s ease;
    }
    
    .blog-nav-link:hover {
        color: #ffffff;
    }
    
    .blog-content {
        margin-top: 80px;
        min-height: 100vh;
    }
    
    @media (max-width: 768px) {
        .blog-nav-menu {
            display: none;
        }
    }
</style>
@endpush

@section('content')
<nav class="blog-nav">
    <div class="blog-nav-container">
        <a href="{{ route('blog.index') }}" class="blog-logo">Sanaa</a>
        <ul class="blog-nav-menu">
            <li><a href="{{ route('home') }}" class="blog-nav-link">Home</a></li>
            <li><a href="{{ route('blog.index') }}" class="blog-nav-link">Stories</a></li>
            <li><a href="{{ route('about') }}" class="blog-nav-link">About</a></li>
            <li><a href="{{ route('contact') }}" class="blog-nav-link">Contact</a></li>
        </ul>
    </div>
</nav>

<main class="blog-content">
    @yield('blog-content')
</main>
@endsection

{{-- routes/web.php additions --}}
<?php
// Add these routes to your existing routes/web.php

// Enhanced blog routes
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/{blog:slug}', [BlogController::class, 'show'])->name('show');
    Route::post('/{blog}/like', [BlogController::class, 'like'])->name('like');
    Route::post('/{blog}/bookmark', [BlogController::class, 'bookmark'])->name('bookmark');
    Route::post('/{blog}/share', [BlogController::class, 'share'])->name('share');
});

// API routes for AJAX functionality
Route::prefix('api')->name('api.')->group(function () {
    Route::post('analytics/track', [BlogController::class, 'trackAnalytics'])->name('analytics.track');
    Route::get('blogs', [BlogController::class, 'index'])->name('blogs.index');
    Route::post('blogs/{blog}/like', [BlogController::class, 'like'])->name('blogs.like');
    Route::post('blogs/{blog}/bookmark', [BlogController::class, 'bookmark'])->name('blogs.bookmark');
    Route::post('blogs/{blog}/share', [BlogController::class, 'share'])->name('blogs.share');
});

// Admin blog management routes (if needed)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('blogs', AdminBlogController::class);
});

{{-- config/blog.php (Configuration file) --}}
<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Blog Settings
    |--------------------------------------------------------------------------
    */
    
    'pagination' => [
        'per_page' => 12,
        'infinite_scroll' => true,
    ],
    
    'seo' => [
        'default_image' => '/images/sanaa-blog-default.jpg',
        'site_name' => 'Sanaa Blog',
        'twitter_handle' => '@sanaa_co',
    ],
    
    'analytics' => [
        'track_reading_time' => true,
        'track_scroll_depth' => true,
        'track_engagement' => true,
    ],
    
    'features' => [
        'text_to_speech' => true,
        'reading_progress' => true,
        'keyboard_shortcuts' => true,
        'font_adjustment' => true,
        'infinite_scroll' => true,
    ],
    
    'cache' => [
        'trending_posts_ttl' => 3600, // 1 hour
        'popular_topics_ttl' => 3600, // 1 hour
        'related_posts_ttl' => 1800, // 30 minutes
    ],
];

{{-- Service Worker for PWA features --}}
{{-- public/sw.js --}}
const CACHE_NAME = 'sanaa-blog-v1';
const STATIC_CACHE_URLS = [
    '/',
    '/blog',
    '/css/app.css',
    '/js/app.js',
    'https://fonts.googleapis.com/css2?family=Charter:ital,wght@0,400;0,700;1,400;1,700&family=Inter:wght@300;400;500;600;700&display=swap'
];

// Install event
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then((cache) => cache.addAll(STATIC_CACHE_URLS))
            .then(() => self.skipWaiting())
    );
});

// Activate event
self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames.map((cacheName) => {
                    if (cacheName !== CACHE_NAME) {
                        return caches.delete(cacheName);
                    }
                })
            );
        }).then(() => self.clients.claim())
    );
});

// Fetch event
self.addEventListener('fetch', (event) => {
    // Skip non-GET requests and external requests
    if (event.request.method !== 'GET' || !event.request.url.startsWith(self.location.origin)) {
        return;
    }

    // Handle blog posts for offline reading
    if (event.request.url.includes('/blog/')) {
        event.respondWith(
            caches.match(event.request)
                .then((response) => {
                    if (response) {
                        return response;
                    }
                    
                    return fetch(event.request)
                        .then((response) => {
                            if (response.status === 200) {
                                const responseClone = response.clone();
                                caches.open(CACHE_NAME)
                                    .then((cache) => cache.put(event.request, responseClone));
                            }
                            return response;
                        });
                })
                .catch(() => {
                    // Return offline page if available
                    return caches.match('/offline.html');
                })
        );
    }
    
    // Default strategy: Network first, fallback to cache
    event.respondWith(
        fetch(event.request)
            .catch(() => caches.match(event.request))
    );
});

{{-- Advanced Dashboard Integration --}}
{{-- resources/views/dashboard/blog-analytics.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Blog Analytics')

@section('content')
<div class="analytics-dashboard">
    <div class="analytics-grid">
        <!-- Key Metrics -->
        <div class="metric-card">
            <h3>Total Views</h3>
            <div class="metric-value">{{ number_format($totalViews) }}</div>
            <div class="metric-change positive">+12% from last month</div>
        </div>
        
        <div class="metric-card">
            <h3>Total Likes</h3>
            <div class="metric-value">{{ number_format($totalLikes) }}</div>
            <div class="metric-change positive">+8% from last month</div>
        </div>
        
        <div class="metric-card">
            <h3>Avg. Reading Time</h3>
            <div class="metric-value">{{ $avgReadingTime }}m</div>
            <div class="metric-change neutral">Same as last month</div>
        </div>
        
        <div class="metric-card">
            <h3>Engagement Rate</h3>
            <div class="metric-value">{{ $engagementRate }}%</div>
            <div class="metric-change positive">+15% from last month</div>
        </div>
    </div>
    
    <!-- Top Articles -->
    <div class="top-articles-section">
        <h3>Top Performing Articles</h3>
        <div class="articles-table">
            @foreach($topArticles as $article)
                <div class="article-row">
                    <div class="article-info">
                        <h4>{{ $article->title }}</h4>
                        <p>{{ $article->formatted_date }}</p>
                    </div>
                    <div class="article-stats">
                        <span>{{ number_format($article->views) }} views</span>
                        <span>{{ $article->likes }} likes</span>
                        <span>{{ $article->shares }} shares</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<style>
.analytics-dashboard {
    padding: 24px;
    background: var(--primary-black);
    color: var(--text-primary);
    min-height: 100vh;
}

.analytics-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 24px;
    margin-bottom: 48px;
}

.metric-card {
    background: var(--secondary-black);
    padding: 24px;
    border-radius: 8px;
    border: 1px solid var(--border-color);
}

.metric-card h3 {
    font-size: 14px;
    color: var(--text-secondary);
    margin-bottom: 8px;
    font-weight: 500;
}

.metric-value {
    font-size: 32px;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 8px;
}

.metric-change {
    font-size: 12px;
    font-weight: 500;
}

.metric-change.positive { color: var(--accent-green); }
.metric-change.negative { color: #ff4444; }
.metric-change.neutral { color: var(--text-tertiary); }

.top-articles-section {
    background: var(--secondary-black);
    padding: 24px;
    border-radius: 8px;
    border: 1px solid var(--border-color);
}

.top-articles-section h3 {
    margin-bottom: 24px;
    color: var(--text-primary);
}

.article-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 0;
    border-bottom: 1px solid var(--border-color);
}

.article-info h4 {
    color: var(--text-primary);
    margin-bottom: 4px;
}

.article-info p {
    color: var(--text-tertiary);
    font-size: 12px;
}

.article-stats {
    display: flex;
    gap: 16px;
    font-size: 12px;
    color: var(--text-secondary);
}
</style>
@endsection