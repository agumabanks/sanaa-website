{{-- resources/views/blog/index.blade.php --}}
@extends('layouts.blog')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    {{-- Hero Section with Featured Post --}}
    @if($featuredPost)
        <section class="mb-16 fade-in">
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-gray-900 to-black">
                @if($featuredPost->featured_image)
                    <div class="absolute inset-0">
                        <img src="{{ $featuredPost->featured_image_url }}" 
                             alt="{{ $featuredPost->title }}" 
                             class="w-full h-full object-cover opacity-40">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>
                    </div>
                @endif
                
                <div class="relative px-8 py-16 lg:px-16 lg:py-24">
                    <div class="max-w-3xl">
                        @if($featuredPost->category)
                            <span class="inline-block px-3 py-1 bg-green-600 text-black text-xs font-semibold rounded-full mb-4">
                                {{ $featuredPost->category->name }}
                            </span>
                        @endif
                        
                        <h1 class="text-3xl lg:text-5xl font-bold mb-4 leading-tight">
                            <a href="{{ $featuredPost->url }}" class="hover:text-green-400 transition-colors">
                                {{ $featuredPost->title }}
                            </a>
                        </h1>
                        
                        <p class="text-lg text-gray-300 mb-6 leading-relaxed">
                            {{ $featuredPost->excerpt }}
                        </p>
                        
                        <div class="flex items-center space-x-6 text-sm text-gray-400">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center">
                                    <span class="text-black font-semibold text-xs">
                                        {{ substr($featuredPost->author->name ?? 'S', 0, 1) }}
                                    </span>
                                </div>
                                <span>{{ $featuredPost->author->name ?? 'Sanaa Team' }}</span>
                            </div>
                            <span>{{ $featuredPost->formatted_date }}</span>
                            <span>{{ $featuredPost->reading_time }} min read</span>
                            <div class="flex items-center space-x-4">
                                <span class="flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>{{ number_format($featuredPost->views) }}</span>
                                </span>
                                <span class="flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"/>
                                    </svg>
                                    <span>{{ $featuredPost->likes }}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <div class="grid lg:grid-cols-3 gap-12">
        {{-- Main Articles Grid --}}
        <div class="lg:col-span-2">
            {{-- Filter Tabs --}}
            <div class="flex items-center space-x-6 mb-8 border-b border-gray-800">
                <button class="filter-tab active pb-3 text-sm font-medium border-b-2 border-green-500 text-green-400" data-filter="all">
                    All Posts
                </button>
                <button class="filter-tab pb-3 text-sm font-medium text-gray-400 hover:text-white transition-colors" data-filter="trending">
                    Trending
                </button>
                <button class="filter-tab pb-3 text-sm font-medium text-gray-400 hover:text-white transition-colors" data-filter="recent">
                    Recent
                </button>
            </div>

            {{-- Articles Grid --}}
            <div id="articles-container" class="space-y-8">
                @foreach($blogs as $blog)
                    <article class="group fade-in" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="flex flex-col md:flex-row gap-6 p-6 rounded-2xl hover:bg-gray-900/30 transition-all duration-300 border border-transparent hover:border-gray-800">
                            @if($blog->featured_image)
                                <div class="md:w-48 md:flex-shrink-0">
                                    <img src="{{ $blog->featured_image_url }}" 
                                         alt="{{ $blog->title }}" 
                                         class="w-full h-48 md:h-32 object-cover rounded-xl group-hover:scale-105 transition-transform duration-300">
                                </div>
                            @endif
                            
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center space-x-3 mb-2">
                                    @if($blog->category)
                                        <span class="inline-block px-2 py-1 bg-green-600/20 text-green-400 text-xs font-medium rounded">
                                            {{ $blog->category->name }}
                                        </span>
                                    @endif
                                    @if($blog->featured)
                                        <span class="inline-block px-2 py-1 bg-yellow-500/20 text-yellow-400 text-xs font-medium rounded">
                                            Featured
                                        </span>
                                    @endif
                                </div>
                                
                                <h2 class="text-xl font-bold mb-2 leading-tight">
                                    <a href="{{ $blog->url }}" class="hover:text-green-400 transition-colors">
                                        {{ $blog->title }}
                                    </a>
                                </h2>
                                
                                <p class="text-gray-400 text-sm mb-4 leading-relaxed">
                                    {{ Str::limit($blog->excerpt, 120) }}
                                </p>
                                
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4 text-xs text-gray-500">
                                        <div class="flex items-center space-x-2">
                                            <div class="w-6 h-6 bg-green-600 rounded-full flex items-center justify-center">
                                                <span class="text-black font-semibold text-xs">
                                                    {{ substr($blog->author->name ?? 'S', 0, 1) }}
                                                </span>
                                            </div>
                                            <span>{{ $blog->author->name ?? 'Sanaa Team' }}</span>
                                        </div>
                                        <span>{{ $blog->formatted_date }}</span>
                                        <span>{{ $blog->reading_time }} min</span>
                                    </div>
                                    
                                    <div class="flex items-center space-x-3 text-xs text-gray-500">
                                        <span class="flex items-center space-x-1">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                            </svg>
                                            <span>{{ number_format($blog->views) }}</span>
                                        </span>
                                        <span class="flex items-center space-x-1">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"/>
                                            </svg>
                                            <span>{{ $blog->likes }}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            {{-- Infinite Scroll Loading --}}
            <div id="loading-indicator" class="hidden text-center py-8">
                <div class="inline-flex items-center space-x-2">
                    <div class="w-4 h-4 bg-green-600 rounded-full animate-pulse"></div>
                    <div class="w-4 h-4 bg-green-600 rounded-full animate-pulse" style="animation-delay: 0.2s"></div>
                    <div class="w-4 h-4 bg-green-600 rounded-full animate-pulse" style="animation-delay: 0.4s"></div>
                </div>
                <p class="text-gray-400 text-sm mt-2">Loading more articles...</p>
            </div>

            {{-- Load More Button (fallback) --}}
            @if($blogs->hasMorePages())
                <div class="text-center mt-12">
                    <button id="load-more-btn" class="px-8 py-3 bg-green-600 hover:bg-green-700 text-black font-medium rounded-full transition-colors">
                        Load More Articles
                    </button>
                </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <div class="space-y-8">
            {{-- Trending Posts --}}
            @if($trendingPosts->count() > 0)
                <div class="bg-gray-900/50 rounded-2xl p-6 border border-gray-800">
                    <h3 class="text-lg font-bold mb-4 flex items-center">
                        <svg class="w-5 h-5 text-green-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/>
                        </svg>
                        Trending
                    </h3>
                    <div class="space-y-4">
                        @foreach($trendingPosts as $trending)
                            <a href="{{ $trending->url }}" class="block group">
                                <div class="flex items-start space-x-3">
                                    <span class="text-2xl font-bold text-green-400 flex-shrink-0">{{ $loop->iteration }}</span>
                                    <div class="min-w-0 flex-1">
                                        <h4 class="font-medium text-sm leading-tight group-hover:text-green-400 transition-colors">
                                            {{ Str::limit($trending->title, 60) }}
                                        </h4>
                                        <div class="flex items-center space-x-2 mt-1 text-xs text-gray-500">
                                            <span>{{ $trending->author->name ?? 'Sanaa Team' }}</span>
                                            <span>•</span>
                                            <span>{{ $trending->relative_date }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Categories --}}
            @if($categories->count() > 0)
                <div class="bg-gray-900/50 rounded-2xl p-6 border border-gray-800">
                    <h3 class="text-lg font-bold mb-4">Topics</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($categories as $category)
                            <a href="{{ route('blog.index', ['category' => $category->slug]) }}" 
                               class="inline-block px-3 py-1 bg-gray-800 hover:bg-green-600 hover:text-black text-sm rounded-full transition-colors">
                                {{ $category->name }}
                                <span class="text-xs opacity-75">({{ $category->blogs_count }})</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Popular Tags --}}
            @if($tags->count() > 0)
                <div class="bg-gray-900/50 rounded-2xl p-6 border border-gray-800">
                    <h3 class="text-lg font-bold mb-4">Popular Tags</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($tags as $tag)
                            <a href="{{ route('blog.index', ['tag' => $tag->slug]) }}" 
                               class="inline-block px-2 py-1 bg-gray-800 hover:bg-gray-700 text-xs rounded transition-colors">
                                #{{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Newsletter Signup --}}
            <div class="bg-gradient-to-br from-green-600/20 to-green-800/20 rounded-2xl p-6 border border-green-500/30">
                <h3 class="text-lg font-bold mb-2">Stay Updated</h3>
                <p class="text-sm text-gray-400 mb-4">Get the latest insights delivered to your inbox.</p>
                <form class="space-y-3" action="#" method="POST">
                    @csrf
                    <input type="email" 
                           placeholder="Enter your email" 
                           class="w-full px-4 py-2 bg-gray-900 border border-gray-700 rounded-lg focus:outline-none focus:border-green-500 text-sm">
                    <button type="submit" 
                            class="w-full bg-green-600 hover:bg-green-700 text-black font-medium py-2 rounded-lg transition-colors text-sm">
                        Subscribe
                    </button>
                </form>
                <p class="text-xs text-gray-500 mt-2">No spam. Unsubscribe anytime.</p>
            </div>

            {{-- About Sanaa --}}
            <div class="bg-gray-900/50 rounded-2xl p-6 border border-gray-800">
                <h3 class="text-lg font-bold mb-3">About Sanaa</h3>
                <p class="text-sm text-gray-400 leading-relaxed">
                    Building digital infrastructure solutions across Africa. We believe in the power of minimalist design and profound simplicity.
                </p>
                <a href="#" class="inline-block mt-3 text-green-400 hover:text-green-300 text-sm transition-colors">
                    Learn more →
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Hidden templates for infinite scroll --}}
<template id="article-template">
    <article class="group fade-in">
        <div class="flex flex-col md:flex-row gap-6 p-6 rounded-2xl hover:bg-gray-900/30 transition-all duration-300 border border-transparent hover:border-gray-800">
            <div class="article-image md:w-48 md:flex-shrink-0" style="display: none;">
                <img class="w-full h-48 md:h-32 object-cover rounded-xl group-hover:scale-105 transition-transform duration-300">
            </div>
            
            <div class="flex-1 min-w-0">
                <div class="flex items-center space-x-3 mb-2">
                    <span class="article-category inline-block px-2 py-1 bg-green-600/20 text-green-400 text-xs font-medium rounded"></span>
                    <span class="article-featured inline-block px-2 py-1 bg-yellow-500/20 text-yellow-400 text-xs font-medium rounded" style="display: none;">Featured</span>
                </div>
                
                <h2 class="text-xl font-bold mb-2 leading-tight">
                    <a class="article-title hover:text-green-400 transition-colors"></a>
                </h2>
                
                <p class="article-excerpt text-gray-400 text-sm mb-4 leading-relaxed"></p>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4 text-xs text-gray-500">
                        <div class="flex items-center space-x-2">
                            <div class="w-6 h-6 bg-green-600 rounded-full flex items-center justify-center">
                                <span class="author-initial text-black font-semibold text-xs"></span>
                            </div>
                            <span class="article-author"></span>
                        </div>
                        <span class="article-date"></span>
                        <span class="article-reading-time"></span>
                    </div>
                    
                    <div class="flex items-center space-x-3 text-xs text-gray-500">
                        <span class="flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="article-views"></span>
                        </span>
                        <span class="flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"/>
                            </svg>
                            <span class="article-likes"></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </article>
</template>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Infinite scroll implementation
    let currentPage = 1;
    let isLoading = false;
    let hasMorePages = {{ $blogs->hasMorePages() ? 'true' : 'false' }};
    
    const articlesContainer = document.getElementById('articles-container');
    const loadingIndicator = document.getElementById('loading-indicator');
    const loadMoreBtn = document.getElementById('load-more-btn');
    const articleTemplate = document.getElementById('article-template');

    // Intersection Observer for infinite scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && hasMorePages && !isLoading) {
                loadMoreArticles();
            }
        });
    }, {
        rootMargin: '100px'
    });

    // Observe the loading indicator
    if (loadingIndicator) {
        observer.observe(loadingIndicator);
    }

    // Load more button click handler
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', loadMoreArticles);
    }

    function loadMoreArticles() {
        if (isLoading || !hasMorePages) return;
        
        isLoading = true;
        showLoading();
        
        fetch(`{{ route('blog.index') }}?page=${currentPage + 1}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.articles && data.articles.length > 0) {
                data.articles.forEach(article => {
                    const articleElement = createArticleElement(article);
                    articlesContainer.appendChild(articleElement);
                    
                    // Trigger fade-in animation
                    setTimeout(() => {
                        articleElement.classList.add('fade-in');
                    }, 50);
                });
                
                currentPage++;
                hasMorePages = data.has_more;
                
                if (!hasMorePages && loadMoreBtn) {
                    loadMoreBtn.style.display = 'none';
                }
            }
        })
        .catch(error => {
            console.error('Error loading articles:', error);
        })
        .finally(() => {
            isLoading = false;
            hideLoading();
        });
    }

    function createArticleElement(article) {
        const template = articleTemplate.content.cloneNode(true);
        const articleEl = template.querySelector('article');
        
        // Set article data
        template.querySelector('.article-title').textContent = article.title;
        template.querySelector('.article-title').href = `/blog/${article.slug}`;
        template.querySelector('.article-excerpt').textContent = article.excerpt.substring(0, 120) + '...';
        template.querySelector('.article-author').textContent = article.author;
        template.querySelector('.author-initial').textContent = article.author.charAt(0);
        template.querySelector('.article-date').textContent = article.formatted_date;
        template.querySelector('.article-reading-time').textContent = article.reading_time + ' min';
        template.querySelector('.article-views').textContent = article.views;
        template.querySelector('.article-likes').textContent = article.likes;
        
        // Handle category
        if (article.category) {
            template.querySelector('.article-category').textContent = article.category;
        } else {
            template.querySelector('.article-category').style.display = 'none';
        }
        
        // Handle featured image
        if (article.featured_image_url) {
            const imageContainer = template.querySelector('.article-image');
            const img = imageContainer.querySelector('img');
            img.src = article.featured_image_url;
            img.alt = article.title;
            imageContainer.style.display = 'block';
        }
        
        // Handle featured status
        if (article.featured) {
            template.querySelector('.article-featured').style.display = 'inline-block';
        }
        
        return template;
    }

    function showLoading() {
        if (loadingIndicator) {
            loadingIndicator.classList.remove('hidden');
        }
        if (loadMoreBtn) {
            loadMoreBtn.disabled = true;
            loadMoreBtn.textContent = 'Loading...';
        }
    }

    function hideLoading() {
        if (loadingIndicator) {
            loadingIndicator.classList.add('hidden');
        }
        if (loadMoreBtn) {
            loadMoreBtn.disabled = false;
            loadMoreBtn.textContent = 'Load More Articles';
        }
    }

    // Filter tabs functionality
    const filterTabs = document.querySelectorAll('.filter-tab');
    filterTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active class from all tabs
            filterTabs.forEach(t => {
                t.classList.remove('active', 'border-green-500', 'text-green-400');
                t.classList.add('text-gray-400');
            });
            
            // Add active class to clicked tab
            this.classList.add('active', 'border-green-500', 'text-green-400');
            this.classList.remove('text-gray-400');
            
            // TODO: Implement actual filtering logic based on filter type
            const filter = this.dataset.filter;
            console.log('Filter changed to:', filter);
        });
    });

    // Mobile menu toggle
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }
});
</script>
@endpush 