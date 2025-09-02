@extends('layouts.blog')

@section('title', $blog->title . ' - ' . config('app.name'))
@section('description', Str::limit(strip_tags($blog->body ?? ''), 160))

@push('meta')
<!-- SEO Meta Tags -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="keywords" content="{{ $blog->tags->pluck('name')->implode(', ') }}">
<meta name="author" content="{{ $blog->author->name ?? 'Anonymous' }}">
<meta name="robots" content="index, follow">
<link rel="canonical" href="{{ url()->current() }}">

<!-- Open Graph -->
<meta property="og:title" content="{{ $blog->title }}">
<meta property="og:description" content="{{ Str::limit(strip_tags($blog->body ?? ''), 160) }}">
<meta property="og:image" content="{{ $blog->featured_image ? asset('storage/' . $blog->featured_image) : asset('images/default-blog-og.jpg') }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="article">
<meta property="og:site_name" content="{{ config('app.name') }}">
<meta property="article:author" content="{{ $blog->author->name ?? 'Anonymous' }}">
<meta property="article:published_time" content="{{ $blog->published_at ? $blog->published_at->toISOString() : $blog->created_at->toISOString() }}">
<meta property="article:section" content="{{ $blog->category->name ?? 'Blog' }}">
@foreach($blog->tags as $tag)
<meta property="article:tag" content="{{ $tag->name }}">
@endforeach

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $blog->title }}">
<meta name="twitter:description" content="{{ Str::limit(strip_tags($blog->body ?? ''), 160) }}">
<meta name="twitter:image" content="{{ $blog->featured_image ? asset('storage/' . $blog->featured_image) : asset('images/default-blog-twitter.jpg') }}">
<meta name="twitter:creator" content="{{ $blog->author->twitter_handle ?? '@' . str_replace(' ', '', $blog->author->name ?? 'anonymous') }}">

<!-- Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "{{ $blog->title }}",
  "description": "{{ Str::limit(strip_tags($blog->body ?? ''), 160) }}",
  "image": "{{ $blog->featured_image ? asset('storage/' . $blog->featured_image) : asset('images/default-blog-schema.jpg') }}",
  "author": {
    "@type": "Person",
    "name": "{{ $blog->author->name ?? 'Anonymous' }}"
  },
  "publisher": {
    "@type": "Organization",
    "name": "{{ config('app.name') }}",
    "logo": {
      "@type": "ImageObject",
      "url": "{{ asset('images/logo.png') }}"
    }
  },
  "datePublished": "{{ $blog->published_at ? $blog->published_at->toISOString() : $blog->created_at->toISOString() }}",
  "dateModified": "{{ $blog->updated_at->toISOString() }}",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "{{ url()->current() }}"
  }
}
</script>
@endpush

@push('styles')
<style>
/* Steve Jobs Minimalism - Pure Black Design */
:root {
  --bg-primary: #000000;
  --bg-secondary: #0a0a0a;
  --bg-elevated: #111111;
  --text-primary: #ffffff;
  --text-secondary: #a0a0a0;
  --text-muted: #666666;
  --accent-green: #00ff88;
  --accent-green-dim: #00cc6a;
  --accent-green-bright: #00ffaa;
  --border-subtle: #1a1a1a;
  --border-visible: #333333;
  --font-primary: 'Charter', 'Times New Roman', serif;
  --font-secondary: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
  --reading-width: 680px;
  --header-height: 64px;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  background: var(--bg-primary);
  color: var(--text-primary);
  font-family: var(--font-primary);
  line-height: 1.6;
  overflow-x: hidden;
}

/* Reading Progress Bar */
.reading-progress {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 3px;
  background: var(--bg-secondary);
  z-index: 1000;
}

.reading-progress-bar {
  height: 100%;
  background: linear-gradient(90deg, var(--accent-green), var(--accent-green-bright));
  width: 0%;
  transition: width 0.1s ease;
  box-shadow: 0 0 10px var(--accent-green);
}

/* Header */
.blog-header {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  height: var(--header-height);
  background: rgba(0, 0, 0, 0.95);
  backdrop-filter: blur(20px);
  border-bottom: 1px solid var(--border-subtle);
  z-index: 999;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 2rem;
  transition: all 0.3s ease;
}

.blog-header.scrolled {
  background: rgba(0, 0, 0, 0.98);
  border-bottom-color: var(--border-visible);
}

.header-left {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.back-link {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  color: var(--text-secondary);
  text-decoration: none;
  font-family: var(--font-secondary);
  font-size: 0.9rem;
  font-weight: 500;
  transition: color 0.2s ease;
}

.back-link:hover {
  color: var(--accent-green);
  text-decoration: none;
}

.header-actions {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.header-btn {
  background: none;
  border: 1px solid var(--border-visible);
  color: var(--text-secondary);
  padding: 0.5rem 1rem;
  border-radius: 20px;
  font-family: var(--font-secondary);
  font-size: 0.85rem;
  cursor: pointer;
  transition: all 0.2s ease;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.header-btn:hover {
  border-color: var(--accent-green);
  color: var(--accent-green);
  transform: translateY(-1px);
}

.header-btn.active {
  background: var(--accent-green);
  color: var(--bg-primary);
  border-color: var(--accent-green);
}

/* Main Content */
.blog-container {
  margin-top: var(--header-height);
  min-height: calc(100vh - var(--header-height));
}

.blog-article {
  max-width: var(--reading-width);
  margin: 0 auto;
  padding: 3rem 2rem;
}

/* Article Header */
.article-header {
  margin-bottom: 3rem;
  text-align: left;
}

.article-category {
  display: inline-block;
  background: var(--accent-green);
  color: var(--bg-primary);
  padding: 0.25rem 0.75rem;
  border-radius: 12px;
  font-family: var(--font-secondary);
  font-size: 0.8rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  margin-bottom: 1.5rem;
  text-decoration: none;
}

.article-title {
  font-size: clamp(2rem, 5vw, 3.5rem);
  font-weight: 700;
  line-height: 1.1;
  margin-bottom: 1rem;
  color: var(--text-primary);
  font-family: var(--font-primary);
}

.article-subtitle {
  font-size: 1.25rem;
  color: var(--text-secondary);
  line-height: 1.4;
  margin-bottom: 2rem;
  font-weight: 400;
}

.article-meta {
  display: flex;
  align-items: center;
  gap: 1.5rem;
  margin-bottom: 2rem;
  flex-wrap: wrap;
}

.author-info {
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

.author-avatar {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  object-fit: cover;
  border: 2px solid var(--border-visible);
}

.author-details {
  display: flex;
  flex-direction: column;
}

.author-name {
  font-family: var(--font-secondary);
  font-size: 0.9rem;
  font-weight: 600;
  color: var(--text-primary);
  text-decoration: none;
}

.author-name:hover {
  color: var(--accent-green);
  text-decoration: none;
}

.meta-info {
  display: flex;
  align-items: center;
  gap: 1rem;
  font-family: var(--font-secondary);
  font-size: 0.85rem;
  color: var(--text-muted);
}

.meta-item {
  display: flex;
  align-items: center;
  gap: 0.25rem;
}

.reading-time {
  background: var(--bg-elevated);
  padding: 0.25rem 0.75rem;
  border-radius: 12px;
  border: 1px solid var(--border-subtle);
}

/* Featured Image */
.featured-image-container {
  margin: 2rem 0 3rem 0;
  border-radius: 12px;
  overflow: hidden;
  background: var(--bg-elevated);
}

.featured-image {
  width: 100%;
  height: auto;
  max-height: 60vh;
  object-fit: cover;
  display: block;
}

/* Article Content */
.article-content {
  font-size: 1.2rem;
  line-height: 1.7;
  color: var(--text-primary);
  margin-bottom: 4rem;
}

.article-content > * {
  margin-bottom: 1.5rem;
}

.article-content > *:last-child {
  margin-bottom: 0;
}

.article-content h1,
.article-content h2,
.article-content h3,
.article-content h4,
.article-content h5,
.article-content h6 {
  font-family: var(--font-primary);
  font-weight: 700;
  line-height: 1.3;
  color: var(--text-primary);
  margin-top: 2.5rem;
  margin-bottom: 1rem;
}

.article-content h1 { font-size: 2.5rem; }
.article-content h2 { font-size: 2rem; }
.article-content h3 { font-size: 1.6rem; }
.article-content h4 { font-size: 1.3rem; }
.article-content h5 { font-size: 1.1rem; }
.article-content h6 { font-size: 1rem; }

.article-content p {
  margin-bottom: 1.5rem;
}

.article-content strong {
  font-weight: 600;
  color: var(--text-primary);
}

.article-content em {
  font-style: italic;
  color: var(--text-secondary);
}

.article-content a {
  color: var(--accent-green);
  text-decoration: underline;
  text-decoration-color: transparent;
  transition: all 0.2s ease;
}

.article-content a:hover {
  text-decoration-color: var(--accent-green);
  color: var(--accent-green-bright);
}

.article-content blockquote {
  border-left: 4px solid var(--accent-green);
  padding: 1.5rem 2rem;
  margin: 2rem 0;
  background: var(--bg-elevated);
  border-radius: 0 8px 8px 0;
  font-style: italic;
  color: var(--text-secondary);
  position: relative;
}

.article-content blockquote::before {
  content: '"';
  font-size: 4rem;
  color: var(--accent-green);
  position: absolute;
  top: -0.5rem;
  left: 1rem;
  font-family: serif;
}

.article-content ul,
.article-content ol {
  padding-left: 2rem;
  margin-bottom: 1.5rem;
}

.article-content li {
  margin-bottom: 0.5rem;
}

.article-content li::marker {
  color: var(--accent-green);
}

.article-content code {
  background: var(--bg-elevated);
  color: var(--accent-green);
  padding: 0.2rem 0.5rem;
  border-radius: 4px;
  font-family: 'Monaco', 'Consolas', monospace;
  font-size: 0.9em;
  border: 1px solid var(--border-subtle);
}

.article-content pre {
  background: var(--bg-elevated);
  border: 1px solid var(--border-visible);
  border-radius: 8px;
  padding: 1.5rem;
  overflow-x: auto;
  margin: 2rem 0;
}

.article-content pre code {
  background: none;
  border: none;
  padding: 0;
  color: var(--text-primary);
}

.article-content img {
  width: 100%;
  height: auto;
  border-radius: 8px;
  margin: 2rem 0;
  border: 1px solid var(--border-subtle);
}

.article-content hr {
  border: none;
  height: 1px;
  background: var(--border-visible);
  margin: 3rem 0;
}

/* Article Content Tables */
.article-content table {
  width: 100%;
  border-collapse: collapse;
  border: 1px solid var(--border-subtle);
  margin: 2rem 0;
  background: var(--bg-elevated);
}

.article-content th,
.article-content td {
  border: 1px solid var(--border-subtle);
  padding: 0.75rem 1rem;
  text-align: left;
}

.article-content thead th {
  background: var(--bg-secondary);
  color: var(--text-primary);
}

.article-content tbody tr:nth-child(even) {
  background: #0c0c0c;
}

/* Tags */
.article-tags {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
  margin: 3rem 0;
  padding-top: 2rem;
  border-top: 1px solid var(--border-subtle);
}

.tag-link {
  background: var(--bg-elevated);
  color: var(--text-secondary);
  padding: 0.5rem 1rem;
  border-radius: 20px;
  text-decoration: none;
  font-family: var(--font-secondary);
  font-size: 0.85rem;
  font-weight: 500;
  border: 1px solid var(--border-subtle);
  transition: all 0.2s ease;
}

.tag-link:hover {
  background: var(--accent-green);
  color: var(--bg-primary);
  border-color: var(--accent-green);
  transform: translateY(-2px);
  text-decoration: none;
}

/* Engagement Section */
.engagement-section {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 2rem 0;
  border-top: 1px solid var(--border-subtle);
  border-bottom: 1px solid var(--border-subtle);
  margin: 3rem 0;
}

.engagement-left {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.engagement-btn {
  background: none;
  border: 1px solid var(--border-visible);
  color: var(--text-secondary);
  padding: 0.75rem 1.5rem;
  border-radius: 25px;
  font-family: var(--font-secondary);
  font-size: 0.9rem;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s ease;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  text-decoration: none;
}

.engagement-btn:hover {
  border-color: var(--accent-green);
  color: var(--accent-green);
  transform: translateY(-2px);
  text-decoration: none;
}

.engagement-btn.active {
  background: var(--accent-green);
  color: var(--bg-primary);
  border-color: var(--accent-green);
}

.engagement-right {
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.share-btn {
  background: none;
  border: none;
  color: var(--text-secondary);
  padding: 0.5rem;
  border-radius: 50%;
  cursor: pointer;
  transition: all 0.2s ease;
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.share-btn:hover {
  background: var(--bg-elevated);
  color: var(--accent-green);
  transform: scale(1.1);
}

/* Author Bio */
.author-bio-section {
  background: var(--bg-elevated);
  border: 1px solid var(--border-subtle);
  border-radius: 12px;
  padding: 2rem;
  margin: 3rem 0;
}

.author-bio-header {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin-bottom: 1rem;
}

.author-bio-avatar {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  object-fit: cover;
  border: 2px solid var(--border-visible);
}

.author-bio-info h3 {
  font-family: var(--font-secondary);
  font-size: 1.2rem;
  font-weight: 600;
  margin-bottom: 0.25rem;
}

.author-bio-info .author-title {
  color: var(--text-muted);
  font-size: 0.9rem;
  font-family: var(--font-secondary);
}

.author-bio-content {
  color: var(--text-secondary);
  line-height: 1.6;
  margin-bottom: 1rem;
}

.follow-author-btn {
  background: var(--accent-green);
  color: var(--bg-primary);
  border: none;
  padding: 0.5rem 1.5rem;
  border-radius: 20px;
  font-family: var(--font-secondary);
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s ease;
  text-decoration: none;
  display: inline-block;
}

.follow-author-btn:hover {
  background: var(--accent-green-bright);
  transform: translateY(-2px);
  text-decoration: none;
  color: var(--bg-primary);
}

/* Navigation */
.article-navigation {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 2rem;
  margin: 4rem 0;
}

.nav-post {
  background: var(--bg-elevated);
  border: 1px solid var(--border-subtle);
  border-radius: 12px;
  padding: 1.5rem;
  text-decoration: none;
  color: var(--text-secondary);
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
}

.nav-post:hover {
  border-color: var(--accent-green);
  transform: translateY(-4px);
  box-shadow: 0 8px 25px rgba(0, 255, 136, 0.1);
  text-decoration: none;
  color: var(--text-primary);
}

.nav-post::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 2px;
  background: var(--accent-green);
  transform: scaleX(0);
  transition: transform 0.3s ease;
}

.nav-post:hover::before {
  transform: scaleX(1);
}

.nav-direction {
  font-family: var(--font-secondary);
  font-size: 0.8rem;
  text-transform: uppercase;
  letter-spacing: 1px;
  margin-bottom: 0.5rem;
  color: var(--text-muted);
}

.nav-title {
  font-size: 1.1rem;
  font-weight: 600;
  line-height: 1.3;
}

.nav-post.next {
  text-align: right;
}

/* Related Posts */
.related-posts {
  margin: 4rem 0;
}

.related-posts-title {
  font-size: 1.8rem;
  font-weight: 700;
  text-align: center;
  margin-bottom: 2rem;
  color: var(--text-primary);
}

.related-posts-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 2rem;
}

.related-post-card {
  background: var(--bg-elevated);
  border: 1px solid var(--border-subtle);
  border-radius: 12px;
  overflow: hidden;
  transition: all 0.3s ease;
  text-decoration: none;
  color: inherit;
}

.related-post-card:hover {
  border-color: var(--accent-green);
  transform: translateY(-8px);
  box-shadow: 0 12px 30px rgba(0, 255, 136, 0.15);
  text-decoration: none;
  color: inherit;
}

.related-post-image {
  width: 100%;
  height: 200px;
  object-fit: cover;
}

.related-post-content {
  padding: 1.5rem;
}

.related-post-category {
  background: var(--accent-green);
  color: var(--bg-primary);
  padding: 0.2rem 0.6rem;
  border-radius: 8px;
  font-family: var(--font-secondary);
  font-size: 0.7rem;
  font-weight: 600;
  text-transform: uppercase;
  margin-bottom: 1rem;
  display: inline-block;
}

.related-post-title {
  font-size: 1.2rem;
  font-weight: 600;
  line-height: 1.3;
  margin-bottom: 0.75rem;
  color: var(--text-primary);
}

.related-post-excerpt {
  color: var(--text-secondary);
  font-size: 0.9rem;
  line-height: 1.5;
  margin-bottom: 1rem;
}

.related-post-meta {
  display: flex;
  align-items: center;
  gap: 1rem;
  font-family: var(--font-secondary);
  font-size: 0.8rem;
  color: var(--text-muted);
}

/* Floating Action Buttons */
.floating-actions {
  position: fixed;
  right: 2rem;
  top: 50%;
  transform: translateY(-50%);
  display: flex;
  flex-direction: column;
  gap: 1rem;
  z-index: 100;
}

.floating-btn {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  background: var(--bg-elevated);
  border: 1px solid var(--border-visible);
  color: var(--text-secondary);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s ease;
  backdrop-filter: blur(10px);
}

.floating-btn:hover {
  background: var(--accent-green);
  color: var(--bg-primary);
  border-color: var(--accent-green);
  transform: scale(1.1);
}

.floating-btn.active {
  background: var(--accent-green);
  color: var(--bg-primary);
  border-color: var(--accent-green);
}

/* Newsletter Signup */
.newsletter-section {
  background: linear-gradient(135deg, var(--bg-elevated), var(--bg-secondary));
  border: 1px solid var(--border-visible);
  border-radius: 16px;
  padding: 3rem 2rem;
  text-align: center;
  margin: 4rem 0;
  position: relative;
  overflow: hidden;
}

.newsletter-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 2px;
  background: linear-gradient(90deg, var(--accent-green), var(--accent-green-bright));
}

.newsletter-title {
  font-size: 1.5rem;
  font-weight: 700;
  margin-bottom: 1rem;
  color: var(--text-primary);
}

.newsletter-description {
  color: var(--text-secondary);
  margin-bottom: 2rem;
  max-width: 400px;
  margin-left: auto;
  margin-right: auto;
}

.newsletter-form {
  display: flex;
  gap: 1rem;
  max-width: 400px;
  margin: 0 auto;
}

.newsletter-input {
  flex: 1;
  background: var(--bg-primary);
  border: 1px solid var(--border-visible);
  border-radius: 8px;
  padding: 0.75rem 1rem;
  color: var(--text-primary);
  font-family: var(--font-secondary);
  font-size: 0.9rem;
}

.newsletter-input:focus {
  outline: none;
  border-color: var(--accent-green);
  box-shadow: 0 0 0 2px rgba(0, 255, 136, 0.2);
}

.newsletter-btn {
  background: var(--accent-green);
  color: var(--bg-primary);
  border: none;
  padding: 0.75rem 1.5rem;
  border-radius: 8px;
  font-family: var(--font-secondary);
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s ease;
  white-space: nowrap;
}

.newsletter-btn:hover {
  background: var(--accent-green-bright);
  transform: translateY(-2px);
}

/* Font Controls */
.font-controls {
  position: fixed;
  bottom: 2rem;
  left: 2rem;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  background: var(--bg-elevated);
  border: 1px solid var(--border-visible);
  border-radius: 25px;
  padding: 0.5rem;
  backdrop-filter: blur(10px);
  z-index: 100;
}

.font-control-btn {
  width: 32px;
  height: 32px;
  border: none;
  background: none;
  color: var(--text-secondary);
  border-radius: 50%;
  cursor: pointer;
  transition: all 0.2s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 600;
}

.font-control-btn:hover {
  background: var(--accent-green);
  color: var(--bg-primary);
}

/* Mobile Optimizations */
@media (max-width: 768px) {
  :root {
    --reading-width: 100%;
  }

  .blog-header {
    padding: 0 1rem;
  }

  .header-actions {
    gap: 0.5rem;
  }

  .header-btn {
    padding: 0.4rem 0.8rem;
    font-size: 0.8rem;
  }

  .blog-article {
    padding: 2rem 1rem;
  }

  .article-title {
    font-size: 2rem;
  }

  .article-subtitle {
    font-size: 1.1rem;
  }

  .article-meta {
    flex-direction: column;
    align-items: flex-start;
    gap: 1rem;
  }

  .article-content {
    font-size: 1.1rem;
  }

  .engagement-section {
    flex-direction: column;
    gap: 1rem;
    align-items: stretch;
  }

  .engagement-left {
    justify-content: center;
  }

  .engagement-right {
    justify-content: center;
  }

  .article-navigation {
    grid-template-columns: 1fr;
  }

  .nav-post.next {
    text-align: left;
  }

  .floating-actions {
    right: 1rem;
    top: auto;
    bottom: 6rem;
    transform: none;
  }

  .font-controls {
    bottom: 1rem;
    left: 1rem;
    right: 1rem;
    justify-content: center;
  }

  .newsletter-form {
    flex-direction: column;
    gap: 0.75rem;
  }

  .related-posts-grid {
    grid-template-columns: 1fr;
  }
}

/* Accessibility */
@media (prefers-reduced-motion: reduce) {
  * {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}

/* High contrast mode */
@media (prefers-contrast: high) {
  :root {
    --text-primary: #ffffff;
    --text-secondary: #cccccc;
    --border-visible: #666666;
    --accent-green: #00ff00;
  }
}

/* Dark mode detection (already dark by default) */
@media (prefers-color-scheme: light) {
  /* Users can override if they prefer light mode */
  .light-mode-toggle {
    display: block;
  }
}

/* Print styles */
@media print {
  .blog-header,
  .floating-actions,
  .font-controls,
  .engagement-section,
  .newsletter-section {
    display: none !important;
  }
  
  .blog-container {
    margin-top: 0;
  }
  
  .article-content {
    color: #000 !important;
  }
}

/* Loading states */
.loading {
  opacity: 0.7;
  pointer-events: none;
}

.skeleton {
  background: linear-gradient(90deg, var(--bg-elevated) 25%, var(--border-subtle) 50%, var(--bg-elevated) 75%);
  background-size: 200% 100%;
  animation: skeleton-loading 1.5s infinite;
}

@keyframes skeleton-loading {
  0% { background-position: 200% 0; }
  100% { background-position: -200% 0; }
}

/* Tooltip */
.tooltip {
  position: relative;
}

.tooltip::after {
  content: attr(data-tooltip);
  position: absolute;
  bottom: 100%;
  left: 50%;
  transform: translateX(-50%);
  background: var(--bg-primary);
  color: var(--text-primary);
  padding: 0.5rem 0.75rem;
  border-radius: 6px;
  font-size: 0.8rem;
  white-space: nowrap;
  opacity: 0;
  pointer-events: none;
  transition: opacity 0.2s ease;
  border: 1px solid var(--border-visible);
  z-index: 1000;
}

.tooltip:hover::after {
  opacity: 1;
}

/* Text-to-speech indicator */
.tts-playing {
  background: linear-gradient(90deg, transparent, var(--accent-green), transparent);
  background-size: 200% 100%;
  animation: tts-highlight 2s infinite;
}

@keyframes tts-highlight {
  0% { background-position: 200% 0; }
  100% { background-position: -200% 0; }
}

/* Smooth scroll behavior */
html {
  scroll-behavior: smooth;
}

/* Focus styles for accessibility */
button:focus,
a:focus,
input:focus {
  outline: 2px solid var(--accent-green);
  outline-offset: 2px;
}

/* Custom scrollbar */
::-webkit-scrollbar {
  width: 8px;
}

::-webkit-scrollbar-track {
  background: var(--bg-secondary);
}

::-webkit-scrollbar-thumb {
  background: var(--border-visible);
  border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
  background: var(--accent-green);
}
</style>
@endpush

@section('content')
<!-- Reading Progress Bar -->
<div class="reading-progress">
  <div class="reading-progress-bar" id="progressBar"></div>
</div>

<!-- Header -->
<header class="blog-header" id="blogHeader">
  <div class="header-left">
    <a href="{{ route('blog.index') }}" class="back-link">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
        <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
      </svg>
      All Posts
    </a>
  </div>
  
  <div class="header-actions">
    <button class="header-btn" id="fontSizeBtn" data-tooltip="Font Size">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
        <path d="M9 4v3h5v12h3V7h5V4H9zm-6 8h3v7h3v-7h3V9H3v3z"/>
      </svg>
    </button>
    
    <button class="header-btn" id="textToSpeechBtn" data-tooltip="Listen">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
        <path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/>
      </svg>
    </button>
    
    <button class="header-btn" id="bookmarkBtn" data-tooltip="Save">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
        <path d="M17 3H7c-1.1 0-1.99.9-1.99 2L5 21l7-3 7 3V5c0-1.1-.9-2-2-2z"/>
      </svg>
    </button>
  </div>
</header>

<!-- Main Content -->
<div class="blog-container">
  <article class="blog-article">
    <!-- Article Header -->
    <header class="article-header">
      @if($blog->category)
      <a href="{{ route('blog.category', $blog->category->slug) }}" class="article-category">
        {{ $blog->category->name }}
      </a>
      @endif
      
      <h1 class="article-title">{{ $blog->title }}</h1>
      
      @if($blog->subtitle)
      <p class="article-subtitle">{{ $blog->subtitle }}</p>
      @endif
      
      <div class="article-meta">
        <div class="author-info">
          <img src="{{ $blog->author && $blog->author->avatar ? asset('storage/' . $blog->author->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(($blog->author ? $blog->author->name : 'Anonymous')) . '&background=00ff88&color=000000' }}"
               alt="{{ $blog->author ? $blog->author->name : 'Anonymous' }}"
               class="author-avatar">
          <div class="author-details">
            <span class="author-name">
              {{ $blog->author ? $blog->author->name : 'Anonymous' }}
            </span>
          </div>
        </div>
        
        <div class="meta-info">
          <div class="meta-item">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
              <path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm2-7h-1V2h-2v2H8V2H6v2H5c-1.1 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z"/>
            </svg>
            {{ $blog->published_at ? $blog->published_at->format('M d, Y') : $blog->created_at->format('M d, Y') }}
          </div>
          
          <div class="meta-item reading-time">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
              <path d="M15,1H9V3H15M21,3H3C1.89,3 1,3.89 1,5V19A2,2 0 0,0 3,21H21A2,2 0 0,0 23,19V5C23,3.89 22.1,3 21,3M21,19H3V5H21"/>
            </svg>
            {{ ceil(str_word_count(strip_tags($blog->body ?? '')) / 200) }} min read
          </div>
          
          @if($blog->views)
          <div class="meta-item">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9M12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17M12,4.5C7,4.5 2.73,7.61 1,12C2.73,16.39 7,19.5 12,19.5C17,19.5 21.27,16.39 23,12C21.27,7.61 17,4.5 12,4.5Z"/>
            </svg>
            {{ number_format($blog->views) }} views
          </div>
          @endif
        </div>
      </div>
    </header>
    
    <!-- Featured Image -->
    @if($blog->featured_image)
    <div class="featured-image-container">
      <img src="{{ asset('storage/' . $blog->featured_image) }}" 
           alt="{{ $blog->title }}" 
           class="featured-image"
           loading="lazy">
    </div>
    @endif
    
    <!-- Article Content -->
    <div class="article-content" id="articleContent">
      @php
        $rawContent = $blog->body ?? '';
        $plainText = trim(strip_tags($rawContent));
        $looksLikeHtml = \Illuminate\Support\Str::of($rawContent)->contains(['<p', '<br', '<h', '<ul', '<ol', '<img', '<a ', '<div', '<span', '<code', '<pre', '<blockquote', '<table']);
      @endphp

      @if($plainText === '')
        <p style="color: var(--text-secondary)">This article has no content yet.</p>
      @elseif($looksLikeHtml)
        {!! $rawContent !!}
      @else
        {!! nl2br(e($rawContent)) !!}
      @endif
    </div>
    
    <!-- Tags -->
    @if($blog->tags && $blog->tags->count() > 0)
    <div class="article-tags">
      @foreach($blog->tags as $tag)
      <a href="{{ route('blog.tag', $tag->slug) }}" class="tag-link">
        {{ $tag->name }}
      </a>
      @endforeach
    </div>
    @endif
    
    <!-- Engagement Section -->
    <div class="engagement-section">
      <div class="engagement-left">
        <button class="engagement-btn" id="likeBtn" data-post-id="{{ $blog->id }}">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12,21.35L10.55,20.03C5.4,15.36 2,12.27 2,8.5 2,5.41 4.42,3 7.5,3C9.24,3 10.91,3.81 12,5.08C13.09,3.81 14.76,3 16.5,3C19.58,3 22,5.41 22,8.5C22,12.27 18.6,15.36 13.45,20.04L12,21.35Z"/>
          </svg>
          <span id="likeCount">{{ $blog->likes ?? 0 }}</span>
        </button>
        
        <button class="engagement-btn" id="shareBtn">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
            <path d="M18,16.08C17.24,16.08 16.56,16.38 16.04,16.85L8.91,12.7C8.96,12.47 9,12.24 9,12C9,11.76 8.96,11.53 8.91,11.3L15.96,7.19C16.5,7.69 17.21,8 18,8A3,3 0 0,0 21,5A3,3 0 0,0 18,2A3,3 0 0,0 15,5C15,5.24 15.04,5.47 15.09,5.7L8.04,9.81C7.5,9.31 6.79,9 6,9A3,3 0 0,0 3,12A3,3 0 0,0 6,15C6.79,15 7.5,14.69 8.04,14.19L15.16,18.34C15.11,18.55 15.08,18.77 15.08,19C15.08,20.61 16.39,21.91 18,21.91C19.61,21.91 20.92,20.6 20.92,19A2.84,2.84 0 0,0 18,16.08Z"/>
          </svg>
          Share
        </button>
      </div>
      
      <div class="engagement-right">
        <button class="share-btn" onclick="shareToTwitter()" data-tooltip="Twitter">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
            <path d="M22.46,6C21.69,6.35 20.86,6.58 20,6.69C20.88,6.16 21.56,5.32 21.88,4.31C21.05,4.81 20.13,5.16 19.16,5.36C18.37,4.5 17.26,4 16,4C13.65,4 11.73,5.92 11.73,8.29C11.73,8.63 11.77,8.96 11.84,9.27C8.28,9.09 5.11,7.38 3,4.79C2.63,5.42 2.42,6.16 2.42,6.94C2.42,8.43 3.17,9.75 4.33,10.5C3.62,10.5 2.96,10.3 2.38,10C2.38,10 2.38,10 2.38,10.03C2.38,12.11 3.86,13.85 5.82,14.24C5.46,14.34 5.08,14.39 4.69,14.39C4.42,14.39 4.15,14.36 3.89,14.31C4.43,16 6,17.26 7.89,17.29C6.43,18.45 4.58,19.13 2.56,19.13C2.22,19.13 1.88,19.11 1.54,19.07C3.44,20.29 5.7,21 8.12,21C16,21 20.33,14.46 20.33,8.79C20.33,8.6 20.33,8.42 20.32,8.23C21.16,7.63 21.88,6.87 22.46,6Z"/>
          </svg>
        </button>
        
        <button class="share-btn" onclick="shareToFacebook()" data-tooltip="Facebook">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
            <path d="M24,12.073C24,5.405,18.6,0,12,0S0,5.405,0,12.073C0,18.1,4.388,23.094,10.125,23.927V15.543H7.078V12.073H10.125V9.404C10.125,6.369,11.917,4.674,14.658,4.674C15.97,4.674,17.344,4.909,17.344,4.909V7.875H15.83C14.33,7.875,13.875,8.8,13.875,9.75V12.073H17.203L16.671,15.543H13.875V23.927C19.612,23.094,24,18.1,24,12.073Z"/>
          </svg>
        </button>
        
        <button class="share-btn" onclick="shareToLinkedIn()" data-tooltip="LinkedIn">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
            <path d="M20.447,20.452H16.893V14.883C16.893,13.555 16.866,11.846 15.041,11.846C13.188,11.846 12.905,13.291 12.905,14.785V20.452H9.351V9H12.765V10.561H12.811C13.288,9.661 14.448,8.711 16.181,8.711C19.782,8.711 20.447,11.081 20.447,14.166V20.452ZM5.337,7.433A2.063,2.063 0 0,1 3.274,5.371A2.063,2.063 0 0,1 5.337,3.308A2.063,2.063 0 0,1 7.4,5.371A2.063,2.063 0 0,1 5.337,7.433ZM7.119,20.452H3.555V9H7.119V20.452ZM22.225,0H1.771C0.792,0 0,0.774 0,1.729V22.271C0,23.227 0.792,24 1.771,24H22.222C23.2,24 24,23.227 24,22.271V1.729C24,0.774 23.2,0 22.222,0H22.225Z"/>
          </svg>
        </button>
        
        <button class="share-btn" onclick="copyToClipboard()" data-tooltip="Copy Link">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
            <path d="M16,1H4C2.89,1 2,1.89 2,3V17H4V3H16V1M19,5H8C6.89,5 6,5.89 6,7V21C6,22.1 6.89,23 8,23H19C20.1,23 21,22.1 21,21V7C21,5.89 20.1,5 19,5M19,21H8V7H19V21Z"/>
          </svg>
        </button>
      </div>
    </div>
    
    <!-- Author Bio -->
    @if($blog->author && $blog->author->bio)
    <section class="author-bio-section">
      <div class="author-bio-header">
        <img src="{{ $blog->author->avatar ? asset('storage/' . $blog->author->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($blog->author->name) . '&background=00ff88&color=000000' }}" 
             alt="{{ $blog->author->name }}" 
             class="author-bio-avatar">
        <div class="author-bio-info">
          <h3>{{ $blog->author->name }}</h3>
          @if($blog->author->title)
          <div class="author-title">{{ $blog->author->title }}</div>
          @endif
        </div>
      </div>
      
      <div class="author-bio-content">
        {{ $blog->author->bio }}
      </div>
      
      <button class="follow-author-btn" disabled>
        Follow Author
      </button>
    </section>
    @endif
    
    <!-- Newsletter Signup -->
    <section class="newsletter-section">
      <h3 class="newsletter-title">Stay Updated</h3>
      <p class="newsletter-description">
        Get the latest articles and insights delivered directly to your inbox.
      </p>
      
      <form class="newsletter-form" id="newsletterForm">
        @csrf
        <input type="email" 
               class="newsletter-input" 
               placeholder="Enter your email" 
               required 
               id="newsletterEmail">
        <button type="submit" class="newsletter-btn">
          Subscribe
        </button>
      </form>
    </section>
    
    <!-- Navigation -->
    @if(isset($previousPost) || isset($nextPost))
    <nav class="article-navigation">
      @if(isset($previousPost))
      <a href="{{ route('blog.show', $previousPost->slug) }}" class="nav-post prev">
        <div class="nav-direction">← Previous</div>
        <div class="nav-title">{{ Str::limit($previousPost->title, 60) }}</div>
      </a>
      @else
      <div></div>
      @endif
      
      @if(isset($nextPost))
      <a href="{{ route('blog.show', $nextPost->slug) }}" class="nav-post next">
        <div class="nav-direction">Next →</div>
        <div class="nav-title">{{ Str::limit($nextPost->title, 60) }}</div>
      </a>
      @endif
    </nav>
    @endif
    
    <!-- Related Posts -->
    @if(isset($relatedPosts) && $relatedPosts->count() > 0)
    <section class="related-posts">
      <h2 class="related-posts-title">Related Articles</h2>
      
      <div class="related-posts-grid">
        @foreach($relatedPosts as $relatedPost)
        <a href="{{ route('blog.show', $relatedPost->slug) }}" class="related-post-card">
          @if($relatedPost->featured_image)
          <img src="{{ asset('storage/' . $relatedPost->featured_image) }}" 
               alt="{{ $relatedPost->title }}" 
               class="related-post-image"
               loading="lazy">
          @endif
          
          <div class="related-post-content">
          @if($relatedPost->category)
            <div class="related-post-category">{{ $relatedPost->category->name }}</div>
          @endif
          
          <h3 class="related-post-title">{{ $relatedPost->title }}</h3>
          
          <p class="related-post-excerpt">
              {{ Str::limit(strip_tags($relatedPost->body ?? ''), 120) }}
          </p>
          
          <div class="related-post-meta">
            <span>{{ $relatedPost->published_at ? $relatedPost->published_at->format('M d, Y') : $relatedPost->created_at->format('M d, Y') }}</span>
            <span>•</span>
            <span>{{ ceil(str_word_count(strip_tags($relatedPost->body ?? '')) / 200) }} min read</span>
          </div>
          </div>
        </a>
        @endforeach
      </div>
    </section>
    @endif
  </article>
</div>

<!-- Floating Action Buttons -->
<div class="floating-actions">
  <button class="floating-btn tooltip" id="scrollTopBtn" data-tooltip="Scroll to Top">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
      <path d="M7.41,15.41L12,10.83L16.59,15.41L18,14L12,8L6,14L7.41,15.41Z"/>
    </svg>
  </button>
  
  <button class="floating-btn tooltip" id="likeBtnFloat" data-tooltip="Like Article">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
      <path d="M12,21.35L10.55,20.03C5.4,15.36 2,12.27 2,8.5 2,5.41 4.42,3 7.5,3C9.24,3 10.91,3.81 12,5.08C13.09,3.81 14.76,3 16.5,3C19.58,3 22,5.41 22,8.5C22,12.27 18.6,15.36 13.45,20.04L12,21.35Z"/>
    </svg>
  </button>
  
  <button class="floating-btn tooltip" id="bookmarkBtnFloat" data-tooltip="Bookmark">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
      <path d="M17,3H7C5.89,3 5,3.89 5,5V21L12,18L19,21V5C19,3.89 18.1,3 17,3Z"/>
    </svg>
  </button>
</div>

<!-- Font Controls -->
<div class="font-controls">
  <button class="font-control-btn tooltip" id="decreaseFontBtn" data-tooltip="Decrease Font Size">
    A-
  </button>
  <button class="font-control-btn tooltip" id="increaseFontBtn" data-tooltip="Increase Font Size">
    A+
  </button>
  <button class="font-control-btn tooltip" id="resetFontBtn" data-tooltip="Reset Font Size">
    A
  </button>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Reading Progress Bar
  const progressBar = document.getElementById('progressBar');
  const blogHeader = document.getElementById('blogHeader');
  const articleContent = document.getElementById('articleContent');
  
  function updateReadingProgress() {
    const windowHeight = window.innerHeight;
    const documentHeight = document.documentElement.scrollHeight - windowHeight;
    const scrolled = window.scrollY;
    const progress = (scrolled / documentHeight) * 100;
    
    progressBar.style.width = Math.min(progress, 100) + '%';
    
    // Header scroll effect
    if (scrolled > 100) {
      blogHeader.classList.add('scrolled');
    } else {
      blogHeader.classList.remove('scrolled');
    }
  }
  
  window.addEventListener('scroll', updateReadingProgress);
  
  // Font Size Controls
  let currentFontSize = 1.2; // Default font size in rem
  const fontSizeMin = 0.9;
  const fontSizeMax = 1.8;
  const fontSizeStep = 0.1;
  
  function updateFontSize(size) {
    currentFontSize = Math.max(fontSizeMin, Math.min(fontSizeMax, size));
    articleContent.style.fontSize = currentFontSize + 'rem';
    localStorage.setItem('blogFontSize', currentFontSize);
  }
  
  // Load saved font size
  const savedFontSize = localStorage.getItem('blogFontSize');
  if (savedFontSize) {
    updateFontSize(parseFloat(savedFontSize));
  }
  
  document.getElementById('increaseFontBtn').addEventListener('click', () => {
    updateFontSize(currentFontSize + fontSizeStep);
  });
  
  document.getElementById('decreaseFontBtn').addEventListener('click', () => {
    updateFontSize(currentFontSize - fontSizeStep);
  });
  
  document.getElementById('resetFontBtn').addEventListener('click', () => {
    updateFontSize(1.2);
  });
  
  // Text-to-Speech
  let speechSynthesis = window.speechSynthesis;
  let currentUtterance = null;
  let isPlaying = false;
  
  function toggleTextToSpeech() {
    const ttsBtn = document.getElementById('textToSpeechBtn');
    
    if (isPlaying) {
      speechSynthesis.cancel();
      isPlaying = false;
      ttsBtn.innerHTML = `
        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
          <path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/>
        </svg>
      `;
      articleContent.classList.remove('tts-playing');
    } else {
      const text = articleContent.innerText;
      currentUtterance = new SpeechSynthesisUtterance(text);
      
      currentUtterance.onstart = () => {
        isPlaying = true;
        articleContent.classList.add('tts-playing');
        ttsBtn.innerHTML = `
          <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
            <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/>
          </svg>
        `;
      };
      
      currentUtterance.onend = () => {
        isPlaying = false;
        articleContent.classList.remove('tts-playing');
        ttsBtn.innerHTML = `
          <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
            <path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/>
          </svg>
        `;
      };
      
      speechSynthesis.speak(currentUtterance);
    }
  }
  
  document.getElementById('textToSpeechBtn').addEventListener('click', toggleTextToSpeech);
  
  // Like Functionality
  let isLiked = localStorage.getItem('liked_{{ $blog->id }}') === 'true';
  let likeCount = {{ $blog->likes ?? 0 }};
  
  function updateLikeButtons() {
    const likeBtns = [document.getElementById('likeBtn'), document.getElementById('likeBtnFloat')];
    const likeCountEl = document.getElementById('likeCount');
    
    likeBtns.forEach(btn => {
      if (btn) {
        if (isLiked) {
          btn.classList.add('active');
        } else {
          btn.classList.remove('active');
        }
      }
    });
    
    if (likeCountEl) {
      likeCountEl.textContent = likeCount;
    }
  }
  
  function toggleLike() {
    isLiked = !isLiked;
    likeCount += isLiked ? 1 : -1;
    
    localStorage.setItem('liked_{{ $blog->id }}', isLiked);
    updateLikeButtons();
    
    // Send AJAX request to server
    fetch('{{ route("blog.like", $blog->slug) }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
      },
      body: JSON.stringify({ liked: isLiked })
    }).catch(error => {
      console.error('Error updating like:', error);
      // Revert on error
      isLiked = !isLiked;
      likeCount += isLiked ? 1 : -1;
      updateLikeButtons();
    });
  }
  
  document.getElementById('likeBtn').addEventListener('click', toggleLike);
  document.getElementById('likeBtnFloat').addEventListener('click', toggleLike);
  updateLikeButtons();
  
  // Bookmark Functionality
  let isBookmarked = localStorage.getItem('bookmarked_{{ $blog->id }}') === 'true';
  
  function updateBookmarkButtons() {
    const bookmarkBtns = [document.getElementById('bookmarkBtn'), document.getElementById('bookmarkBtnFloat')];
    
    bookmarkBtns.forEach(btn => {
      if (btn) {
        if (isBookmarked) {
          btn.classList.add('active');
        } else {
          btn.classList.remove('active');
        }
      }
    });
  }
  
  function toggleBookmark() {
    isBookmarked = !isBookmarked;
    localStorage.setItem('bookmarked_{{ $blog->id }}', isBookmarked);
    updateBookmarkButtons();
    
    // Send AJAX request to server
    fetch('{{ route("blog.bookmark", $blog->slug) }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
      },
      body: JSON.stringify({ bookmarked: isBookmarked })
    }).catch(error => {
      console.error('Error updating bookmark:', error);
    });
  }
  
  document.getElementById('bookmarkBtn').addEventListener('click', toggleBookmark);
  document.getElementById('bookmarkBtnFloat').addEventListener('click', toggleBookmark);
  updateBookmarkButtons();
  
  // Scroll to Top
  document.getElementById('scrollTopBtn').addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
  
  // Newsletter Signup
  document.getElementById('newsletterForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const email = document.getElementById('newsletterEmail').value;
    const submitBtn = this.querySelector('.newsletter-btn');
    const originalText = submitBtn.textContent;
    
    submitBtn.textContent = 'Subscribing...';
    submitBtn.disabled = true;
    
    fetch('{{ route("newsletter.subscribe") }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
      },
      body: JSON.stringify({ email: email })
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        submitBtn.textContent = 'Subscribed!';
        submitBtn.style.background = 'var(--accent-green)';
        document.getElementById('newsletterEmail').value = '';
        
        setTimeout(() => {
          submitBtn.textContent = originalText;
          submitBtn.disabled = false;
          submitBtn.style.background = '';
        }, 3000);
      } else {
        throw new Error(data.message || 'Subscription failed');
      }
    })
    .catch(error => {
      console.error('Newsletter subscription error:', error);
      submitBtn.textContent = 'Try Again';
      submitBtn.disabled = false;
      
      setTimeout(() => {
        submitBtn.textContent = originalText;
      }, 3000);
    });
  });
  
  // Keyboard Shortcuts
  document.addEventListener('keydown', function(e) {
    // Only trigger if not in input field
    if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') return;
    
    switch(e.key.toLowerCase()) {
      case 'l':
        e.preventDefault();
        toggleLike();
        break;
      case 's':
        e.preventDefault();
        toggleBookmark();
        break;
      case 'p':
        e.preventDefault();
        toggleTextToSpeech();
        break;
      case '+':
      case '=':
        e.preventDefault();
        document.getElementById('increaseFontBtn').click();
        break;
      case '-':
        e.preventDefault();
        document.getElementById('decreaseFontBtn').click();
        break;
      case '0':
        e.preventDefault();
        document.getElementById('resetFontBtn').click();
        break;
      case 'escape':
        if (isPlaying) {
          toggleTextToSpeech();
        }
        break;
    }
  });
  
  // Analytics Tracking
  function trackAnalytics() {
    const startTime = Date.now();
    let maxScrollDepth = 0;
    let timeSpent = 0;
    
    function updateScrollDepth() {
      const scrollTop = window.scrollY;
      const documentHeight = document.documentElement.scrollHeight - window.innerHeight;
      const scrollDepth = Math.round((scrollTop / documentHeight) * 100);
      maxScrollDepth = Math.max(maxScrollDepth, scrollDepth);
    }
    
    function sendAnalytics() {
      timeSpent = Math.round((Date.now() - startTime) / 1000);
      
      // Analytics tracking - route doesn't exist, so we'll just log to console
      console.log('Analytics:', {
        time_spent: timeSpent,
        scroll_depth: maxScrollDepth,
        liked: isLiked,
        bookmarked: isBookmarked,
        completed_reading: maxScrollDepth >= 90
      });
    }
    
    window.addEventListener('scroll', updateScrollDepth);
    window.addEventListener('beforeunload', sendAnalytics);
    
    // Send analytics every 30 seconds for active users
    setInterval(() => {
      if (document.visibilityState === 'visible') {
        sendAnalytics();
      }
    }, 30000);
  }

  trackAnalytics();

  // Smooth scroll for anchor links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });

  // Lazy loading for images
  if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const img = entry.target;
          img.src = img.dataset.src || img.src;
          img.classList.remove('loading');
          observer.unobserve(img);
        }
      });
    });

    document.querySelectorAll('img[loading="lazy"]').forEach(img => {
      imageObserver.observe(img);
    });
  }
});

// Performance monitoring
window.addEventListener('load', () => {
  // Log performance metrics
  if (window.performance && window.performance.timing) {
    const timing = window.performance.timing;
    const pageLoadTime = timing.loadEventEnd - timing.navigationStart;

    // Note: Performance tracking route doesn't exist, so we'll skip this
    console.log('Page load time:', pageLoadTime + 'ms');
  }
});

// Social Share Functions
function shareToTwitter() {
  const url = encodeURIComponent(window.location.href);
  const text = encodeURIComponent('{{ $blog->title }}');
  const via = 'your_twitter_handle'; // Replace with your Twitter handle
  
  window.open(
    `https://twitter.com/intent/tweet?text=${text}&url=${url}&via=${via}`,
    'twitter-share',
    'width=550,height=420'
  );
}

function shareToFacebook() {
  const url = encodeURIComponent(window.location.href);
  
  window.open(
    `https://www.facebook.com/sharer/sharer.php?u=${url}`,
    'facebook-share',
    'width=580,height=400'
  );
}

function shareToLinkedIn() {
  const url = encodeURIComponent(window.location.href);
  const title = encodeURIComponent('{{ $blog->title }}');
  const summary = encodeURIComponent('{{ Str::limit(strip_tags($blog->content), 160) }}');
  
  window.open(
    `https://www.linkedin.com/sharing/share-offsite/?url=${url}&title=${title}&summary=${summary}`,
    'linkedin-share',
    'width=520,height=570'
  );
}

function copyToClipboard() {
  const url = window.location.href;
  
  if (navigator.clipboard && window.isSecureContext) {
    navigator.clipboard.writeText(url).then(() => {
      showCopySuccess();
    }).catch(err => {
      console.error('Failed to copy: ', err);
      fallbackCopy(url);
    });
  } else {
    fallbackCopy(url);
  }
}

function fallbackCopy(text) {
  const textArea = document.createElement('textarea');
  textArea.value = text;
  textArea.style.position = 'fixed';
  textArea.style.left = '-999999px';
  textArea.style.top = '-999999px';
  document.body.appendChild(textArea);
  textArea.focus();
  textArea.select();
  
  try {
    document.execCommand('copy');
    showCopySuccess();
  } catch (err) {
    console.error('Fallback copy failed: ', err);
  }
  
  document.body.removeChild(textArea);
}

function showCopySuccess() {
  // Create temporary success message
  const message = document.createElement('div');
  message.textContent = 'Link copied to clipboard!';
  message.style.cssText = `
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: var(--accent-green);
    color: var(--bg-primary);
    padding: 1rem 2rem;
    border-radius: 8px;
    font-family: var(--font-secondary);
    font-weight: 600;
    z-index: 10000;
    animation: fadeInOut 2s ease;
  `;
  
  // Add CSS animation
  const style = document.createElement('style');
  style.textContent = `
    @keyframes fadeInOut {
      0%, 100% { opacity: 0; transform: translate(-50%, -50%) scale(0.9); }
      10%, 90% { opacity: 1; transform: translate(-50%, -50%) scale(1); }
    }
  `;
  document.head.appendChild(style);
  document.body.appendChild(message);
  
  setTimeout(() => {
    document.body.removeChild(message);
    document.head.removeChild(style);
  }, 2000);
}

// Enhanced share function with native share API
document.getElementById('shareBtn')?.addEventListener('click', function() {
  if (navigator.share) {
    navigator.share({
      title: '{{ $blog->title }}',
      text: '{{ Str::limit(strip_tags($blog->content), 160) }}',
      url: window.location.href
    }).catch(err => {
      console.log('Error sharing:', err);
    });
  } else {
    // Fallback to custom share menu
    showShareMenu();
  }
});

function showShareMenu() {
  // Create custom share popup
  const shareMenu = document.createElement('div');
  shareMenu.innerHTML = `
    <div style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.8); z-index: 10000; display: flex; align-items: center; justify-content: center;" onclick="this.remove()">
      <div style="background: var(--bg-elevated); border: 1px solid var(--border-visible); border-radius: 12px; padding: 2rem; max-width: 400px; width: 90%;" onclick="event.stopPropagation()">
        <h3 style="color: var(--text-primary); margin-bottom: 1rem; text-align: center;">Share this article</h3>
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;">
          <button onclick="shareToTwitter(); this.closest('div').remove();" style="background: #1da1f2; color: white; border: none; padding: 0.75rem; border-radius: 8px; cursor: pointer;">Twitter</button>
          <button onclick="shareToFacebook(); this.closest('div').remove();" style="background: #4267b2; color: white; border: none; padding: 0.75rem; border-radius: 8px; cursor: pointer;">Facebook</button>
          <button onclick="shareToLinkedIn(); this.closest('div').remove();" style="background: #0077b5; color: white; border: none; padding: 0.75rem; border-radius: 8px; cursor: pointer;">LinkedIn</button>
          <button onclick="copyToClipboard(); this.closest('div').remove();" style="background: var(--accent-green); color: var(--bg-primary); border: none; padding: 0.75rem; border-radius: 8px; cursor: pointer;">Copy Link</button>
        </div>
      </div>
    </div>
  `;
  document.body.appendChild(shareMenu);
}

// Service Worker Registration for PWA
if ('serviceWorker' in navigator) {
  window.addEventListener('load', () => {
    navigator.serviceWorker.register('/sw.js')
      .then(registration => {
        console.log('SW registered: ', registration);
      })
      .catch(registrationError => {
        console.log('SW registration failed: ', registrationError);
      });
  });
}

// Performance monitoring
window.addEventListener('load', () => {
  // Log performance metrics
  if (window.performance && window.performance.timing) {
    const timing = window.performance.timing;
    const pageLoadTime = timing.loadEventEnd - timing.navigationStart;
    
    // Performance tracking route doesn't exist, so we'll skip this
    console.log('Performance tracking skipped - route not defined');
  }
});

// Reading time accuracy tracking
let readingStartTime = Date.now();
let isReading = true;

document.addEventListener('visibilitychange', () => {
  if (document.visibilityState === 'hidden') {
    isReading = false;
  } else {
    isReading = true;
    readingStartTime = Date.now();
  }
});

// Detect if user is actively reading (scroll, mouse movement, etc.)
let lastActivity = Date.now();
['scroll', 'mousemove', 'keydown', 'touchstart'].forEach(event => {
  document.addEventListener(event, () => {
    lastActivity = Date.now();
    isReading = true;
  });
});

// Check if user is idle (no activity for 30 seconds)
setInterval(() => {
  if (Date.now() - lastActivity > 30000) {
    isReading = false;
  }
}, 5000);
</script>
@endpush
