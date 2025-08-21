@extends('layouts.app')

@section('title', $post->title . ' - ' . config('app.name'))
@section('description', Str::limit(strip_tags($post->content), 160))

@push('meta')
<meta property="og:title" content="{{ $post->title }}">
<meta property="og:description" content="{{ Str::limit(strip_tags($post->content), 160) }}">
<meta property="og:image" content="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : asset('images/default-blog.jpg') }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="article">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $post->title }}">
<meta name="twitter:description" content="{{ Str::limit(strip_tags($post->content), 160) }}">
<meta name="twitter:image" content="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : asset('images/default-blog.jpg') }}">
@endpush

@push('styles')
<style>
    .blog-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .blog-header {
        text-align: center;
        margin-bottom: 3rem;
        padding-top: 2rem;
    }

    .blog-title {
        font-size: 2.5rem;
        font-weight: 700;
        line-height: 1.2;
        color: #1a202c;
        margin-bottom: 1rem;
    }

    .blog-meta {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 1.5rem;
        color: #718096;
        font-size: 0.9rem;
        margin-bottom: 1rem;
        flex-wrap: wrap;
    }

    .blog-meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .blog-meta-icon {
        width: 16px;
        height: 16px;
        fill: currentColor;
    }

    .blog-tags {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        flex-wrap: wrap;
        margin-bottom: 2rem;
    }

    .blog-tag {
        background: #e2e8f0;
        color: #4a5568;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.8rem;
        text-decoration: none;
        transition: all 0.2s;
    }

    .blog-tag:hover {
        background: #cbd5e0;
        text-decoration: none;
    }

    .featured-image {
        width: 100%;
        max-width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 3rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .blog-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #2d3748;
        margin-bottom: 3rem;
    }

    .blog-content h1,
    .blog-content h2,
    .blog-content h3,
    .blog-content h4,
    .blog-content h5,
    .blog-content h6 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-weight: 600;
        color: #1a202c;
    }

    .blog-content h2 {
        font-size: 1.8rem;
        border-bottom: 2px solid #e2e8f0;
        padding-bottom: 0.5rem;
    }

    .blog-content p {
        margin-bottom: 1.5rem;
    }

    .blog-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 1.5rem 0;
    }

    .blog-content blockquote {
        border-left: 4px solid #4299e1;
        padding-left: 1rem;
        margin: 1.5rem 0;
        font-style: italic;
        color: #4a5568;
        background: #f7fafc;
        padding: 1rem;
        border-radius: 0 8px 8px 0;
    }

    .blog-content code {
        background: #f1f5f9;
        padding: 0.2rem 0.4rem;
        border-radius: 4px;
        font-family: 'Monaco', 'Consolas', monospace;
        font-size: 0.9rem;
    }

    .blog-content pre {
        background: #1a202c;
        color: #e2e8f0;
        padding: 1rem;
        border-radius: 8px;
        overflow-x: auto;
        margin: 1.5rem 0;
    }

    .blog-content pre code {
        background: none;
        padding: 0;
        color: inherit;
    }

    .author-section {
        background: #f8fafc;
        border-radius: 12px;
        padding: 2rem;
        margin-bottom: 3rem;
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .author-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        flex-shrink: 0;
    }

    .author-info h4 {
        margin: 0 0 0.5rem 0;
        font-size: 1.2rem;
        color: #1a202c;
    }

    .author-bio {
        color: #718096;
        font-size: 0.9rem;
        margin: 0;
    }

    .social-share {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 3rem;
        text-align: center;
    }

    .social-share h4 {
        margin-bottom: 1rem;
        color: #1a202c;
        font-size: 1.1rem;
    }

    .social-buttons {
        display: flex;
        justify-content: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .social-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s;
        font-size: 0.9rem;
    }

    .social-btn:hover {
        transform: translateY(-2px);
        text-decoration: none;
    }

    .social-btn.twitter {
        background: #1da1f2;
        color: white;
    }

    .social-btn.facebook {
        background: #4267b2;
        color: white;
    }

    .social-btn.linkedin {
        background: #0077b5;
        color: white;
    }

    .social-btn.copy {
        background: #718096;
        color: white;
    }

    .navigation {
        display: flex;
        justify-content: space-between;
        gap: 2rem;
        margin-bottom: 3rem;
        padding-top: 2rem;
        border-top: 1px solid #e2e8f0;
    }

    .nav-post {
        flex: 1;
        text-decoration: none;
        color: #4a5568;
        padding: 1rem;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        transition: all 0.2s;
    }

    .nav-post:hover {
        border-color: #cbd5e0;
        text-decoration: none;
        color: #2d3748;
    }

    .nav-post.next {
        text-align: right;
    }

    .nav-label {
        font-size: 0.8rem;
        text-transform: uppercase;
        color: #718096;
        margin-bottom: 0.5rem;
    }

    .nav-title {
        font-weight: 600;
        font-size: 1rem;
    }

    .related-posts {
        margin-bottom: 3rem;
    }

    .related-posts h3 {
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
        color: #1a202c;
        text-align: center;
    }

    .related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .related-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s;
        text-decoration: none;
        color: inherit;
    }

    .related-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        text-decoration: none;
        color: inherit;
    }

    .related-image {
        width: 100%;
        height: 150px;
        object-fit: cover;
    }

    .related-content {
        padding: 1rem;
    }

    .related-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #1a202c;
    }

    .related-excerpt {
        font-size: 0.9rem;
        color: #718096;
        line-height: 1.5;
    }

    .back-to-blog {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #4299e1;
        text-decoration: none;
        font-weight: 500;
        margin-bottom: 2rem;
        transition: color 0.2s;
    }

    .back-to-blog:hover {
        color: #3182ce;
        text-decoration: none;
    }

    .reading-time {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #718096;
        font-size: 0.9rem;
    }

    @media (max-width: 768px) {
        .blog-container {
            padding: 0 15px;
        }

        .blog-title {
            font-size: 2rem;
        }

        .blog-meta {
            flex-direction: column;
            gap: 0.5rem;
        }

        .featured-image {
            height: 250px;
        }

        .author-section {
            flex-direction: column;
            text-align: center;
        }

        .navigation {
            flex-direction: column;
        }

        .nav-post.next {
            text-align: left;
        }

        .social-buttons {
            flex-direction: column;
            align-items: center;
        }

        .related-grid {
            grid-template-columns: 1fr;
        }
    }

    .copy-success {
        background: #48bb78 !important;
        color: white !important;
    }
</style>
@endpush

@section('content')
<div class="blog-container">
    <!-- Back to Blog Link -->
    <a href="{{ route('blog.index') }}" class="back-to-blog">
        <svg class="blog-meta-icon" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
        </svg>
        Back to Blog
    </a>

    <!-- Blog Header -->
    <header class="blog-header">
        <h1 class="blog-title">{{ $post->title }}</h1>
        
        <div class="blog-meta">
            <div class="blog-meta-item">
                <svg class="blog-meta-icon" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                </svg>
                <span>{{ $post->author->name ?? 'Anonymous' }}</span>
            </div>
            
            <div class="blog-meta-item">
                <svg class="blog-meta-icon" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                </svg>
                <span>{{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}</span>
            </div>
            
            <div class="blog-meta-item reading-time">
                <svg class="blog-meta-icon" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                </svg>
                <span>{{ ceil(str_word_count(strip_tags($post->content)) / 200) }} min read</span>
            </div>
            
            @if($post->views_count)
            <div class="blog-meta-item">
                <svg class="blog-meta-icon" viewBox="0 0 20 20">
                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                </svg>
                <span>{{ number_format($post->views_count) }} views</span>
            </div>
            @endif
        </div>

        @if($post->tags && $post->tags->count() > 0)
        <div class="blog-tags">
            @foreach($post->tags as $tag)
            <a href="{{ route('blog.tag', $tag->slug) }}" class="blog-tag">#{{ $tag->name }}</a>
            @endforeach
        </div>
        @endif
    </header>

    <!-- Featured Image -->
    @if($post->featured_image)
    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="featured-image">
    @endif

    <!-- Blog Content -->
    <article class="blog-content">
        {!! $post->content !!}
    </article>

    <!-- Author Section -->
    @if($post->author)
    <div class="author-section">
        <img src="{{ $post->author->avatar ? asset('storage/' . $post->author->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($post->author->name) . '&background=4299e1&color=ffffff' }}" 
             alt="{{ $post->author->name }}" 
             class="author-avatar">
        <div class="author-info">
            <h4>{{ $post->author->name }}</h4>
            @if($post->author->bio)
            <p class="author-bio">{{ $post->author->bio }}</p>
            @endif
        </div>
    </div>
    @endif

    <!-- Social Share -->
    <div class="social-share">
        <h4>Share this post</h4>
        <div class="social-buttons">
            <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(url()->current()) }}" 
               target="_blank" 
               class="social-btn twitter">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                </svg>
                Twitter
            </a>
            
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
               target="_blank" 
               class="social-btn facebook">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
                Facebook
            </a>
            
            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" 
               target="_blank" 
               class="social-btn linkedin">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                </svg>
                LinkedIn
            </a>
            
            <button onclick="copyToClipboard()" class="social-btn copy" id="copyBtn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M16 1H4c-1.1 0-2 .9-2 2v14h2V3h12V1zm3 4H8c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h11c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm0 16H8V7h11v14z"/>
                </svg>
                Copy Link
            </button>
        </div>
    </div>

    <!-- Related Posts -->
    @if(isset($relatedPosts) && $relatedPosts->count() > 0)
    <section class="related-posts">
        <h3>Related Posts</h3>
        <div class="related-grid">
            @foreach($relatedPosts as $relatedPost)
            <a href="{{ route('blog.show', $relatedPost->slug) }}" class="related-card">
                @if($relatedPost->featured_image)
                <img src="{{ asset('storage/' . $relatedPost->featured_image) }}" alt="{{ $relatedPost->title }}" class="related-image">
                @endif
                <div class="related-content">
                    <h4 class="related-title">{{ $relatedPost->title }}</h4>
                    <p class="related-excerpt">{{ Str::limit(strip_tags($relatedPost->content), 100) }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Navigation -->
    <nav class="navigation">
        @if(isset($previousPost))
        <a href="{{ route('blog.show', $previousPost->slug) }}" class="nav-post prev">
            <div class="nav-label">Previous Post</div>
            <div class="nav-title">{{ Str::limit($previousPost->title, 50) }}</div>
        </a>
        @else
        <div></div>
        @endif

        @if(isset($nextPost))
        <a href="{{ route('blog.show', $nextPost->slug) }}" class="nav-post next">
            <div class="nav-label">Next Post</div>
            <div class="nav-title">{{ Str::limit($nextPost->title, 50) }}</div>
        </a>
        @endif
    </nav>
</div>
@endsection

@push('scripts')
<script>
function copyToClipboard() {
    const url = window.location.href;
    const copyBtn = document.getElementById('copyBtn');
    
    navigator.clipboard.writeText(url).then(function() {
        const originalHTML = copyBtn.innerHTML;
        copyBtn.classList.add('copy-success');
        copyBtn.innerHTML = `
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
            </svg>
            Copied!
        `;
        
        setTimeout(() => {
            copyBtn.classList.remove('copy-success');
            copyBtn.innerHTML = originalHTML;
        }, 2000);
    }).catch(function(err) {
        console.error('Could not copy text: ', err);
        // Fallback for older browsers
        const textArea = document.createElement('textarea');
        textArea.value = url;
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        try {
            document.execCommand('copy');
            const originalHTML = copyBtn.innerHTML;
            copyBtn.classList.add('copy-success');
            copyBtn.innerHTML = `
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                </svg>
                Copied!
            `;
            
            setTimeout(() => {
                copyBtn.classList.remove('copy-success');
                copyBtn.innerHTML = originalHTML;
            }, 2000);
        } catch (err) {
            console.error('Fallback: Could not copy text: ', err);
        }
        document.body.removeChild(textArea);
    });
}

// Smooth scroll for anchor links within content
document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('.blog-content a[href^="#"]');
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
</script>
@endpush