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

            {{-- Pagination Controls --}}
            <div class="mt-12">
                {{-- Pagination Mode Toggle --}}
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-4">
                        <button id="infinite-scroll-btn" class="px-4 py-2 bg-green-600 text-black text-sm font-medium rounded-lg transition-colors">
                            Infinite Scroll
                        </button>
                        <button id="pagination-btn" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white text-sm font-medium rounded-lg transition-colors">
                            Page Numbers
                        </button>
                    </div>
                    <div class="text-sm text-gray-400">
                        Showing {{ $blogs->firstItem() }}-{{ $blogs->lastItem() }} of {{ $blogs->total() }} articles
                    </div>
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

                {{-- Load More Button (for infinite scroll) --}}
                <div id="load-more-container" class="text-center {{ $blogs->hasMorePages() ? '' : 'hidden' }}">
                    <button id="load-more-btn" class="px-8 py-3 bg-green-600 hover:bg-green-700 text-black font-medium rounded-full transition-colors">
                        Load More Articles
                    </button>
                </div>

                {{-- Google-like Pagination --}}
                <div id="pagination-container" class="hidden">
                    <div class="flex items-center justify-between">
                        {{-- Previous Button --}}
                        @if($blogs->onFirstPage())
                            <span class="px-4 py-2 text-gray-500 cursor-not-allowed">Previous</span>
                        @else
                            <a href="{{ $blogs->previousPageUrl() }}" class="px-4 py-2 bg-gray-800 hover:bg-gray-700 text-white rounded-lg transition-colors">
                                Previous
                            </a>
                        @endif

                        {{-- Page Numbers --}}
                        <div class="flex items-center space-x-2">
                            {{-- First Page --}}
                            @if($blogs->currentPage() > 3)
                                <a href="{{ $blogs->url(1) }}" class="px-3 py-2 bg-gray-800 hover:bg-gray-700 text-white rounded-lg transition-colors">1</a>
                                @if($blogs->currentPage() > 4)
                                    <span class="px-2 py-2 text-gray-500">...</span>
                                @endif
                            @endif

                            {{-- Page Numbers Around Current --}}
                            @for($page = max(1, $blogs->currentPage() - 2); $page <= min($blogs->lastPage(), $blogs->currentPage() + 2); $page++)
                                @if($page == $blogs->currentPage())
                                    <span class="px-3 py-2 bg-green-600 text-black rounded-lg font-medium">{{ $page }}</span>
                                @else
                                    <a href="{{ $blogs->url($page) }}" class="px-3 py-2 bg-gray-800 hover:bg-gray-700 text-white rounded-lg transition-colors">{{ $page }}</a>
                                @endif
                            @endfor

                            {{-- Last Page --}}
                            @if($blogs->currentPage() < $blogs->lastPage() - 2)
                                @if($blogs->currentPage() < $blogs->lastPage() - 3)
                                    <span class="px-2 py-2 text-gray-500">...</span>
                                @endif
                                <a href="{{ $blogs->url($blogs->lastPage()) }}" class="px-3 py-2 bg-gray-800 hover:bg-gray-700 text-white rounded-lg transition-colors">{{ $blogs->lastPage() }}</a>
                            @endif
                        </div>

                        {{-- Next Button --}}
                        @if($blogs->hasMorePages())
                            <a href="{{ $blogs->nextPageUrl() }}" class="px-4 py-2 bg-gray-800 hover:bg-gray-700 text-white rounded-lg transition-colors">
                                Next
                            </a>
                        @else
                            <span class="px-4 py-2 text-gray-500 cursor-not-allowed">Next</span>
                        @endif
                    </div>

                    {{-- Pagination Info --}}
                    <div class="text-center mt-4 text-sm text-gray-400">
                        Page {{ $blogs->currentPage() }} of {{ $blogs->lastPage() }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Enhanced Sidebar --}}
        <div class="space-y-6 lg:sticky lg:top-8">
            {{-- Trending Posts --}}
            @if($trendingPosts->count() > 0)
                <div class="sidebar-card bg-gray-900/50 rounded-2xl p-6 border border-gray-800 hover:border-gray-700 transition-all duration-300 group">
                    <h3 class="text-lg font-bold mb-4 flex items-center group-hover:text-green-400 transition-colors">
                        <svg class="w-5 h-5 text-green-400 mr-2 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/>
                        </svg>
                        Trending Now
                        <span class="ml-auto text-xs text-gray-500 opacity-0 group-hover:opacity-100 transition-opacity">Hot</span>
                    </h3>
                    <div class="space-y-3">
                        @foreach($trendingPosts as $trending)
                            <a href="{{ $trending->url }}" class="trending-item block group p-3 rounded-xl hover:bg-gray-800/50 transition-all duration-200 hover:scale-[1.02] hover:shadow-lg">
                                <div class="flex items-start space-x-3">
                                    <span class="trending-number text-xl font-bold text-green-400 flex-shrink-0 group-hover:scale-110 transition-transform">{{ $loop->iteration }}</span>
                                    <div class="min-w-0 flex-1">
                                        <h4 class="font-medium text-sm leading-tight group-hover:text-green-400 transition-colors line-clamp-2">
                                            {{ Str::limit($trending->title, 60) }}
                                        </h4>
                                        <div class="flex items-center space-x-2 mt-2 text-xs text-gray-500">
                                            <span class="group-hover:text-gray-400 transition-colors">{{ $trending->author->name ?? 'Sanaa Team' }}</span>
                                            <span class="text-gray-600">•</span>
                                            <span class="group-hover:text-gray-400 transition-colors">{{ $trending->relative_date }}</span>
                                        </div>
                                    </div>
                                    <svg class="w-4 h-4 text-gray-600 opacity-0 group-hover:opacity-100 transition-opacity mt-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Categories --}}
            @if($categories->count() > 0)
                <div class="sidebar-card bg-gray-900/50 rounded-2xl p-6 border border-gray-800 hover:border-gray-700 transition-all duration-300">
                    <h3 class="text-lg font-bold mb-4 flex items-center justify-between">
                        <span>Explore Topics</span>
                        <span class="text-xs text-gray-500 bg-gray-800 px-2 py-1 rounded-full">{{ $categories->count() }}</span>
                    </h3>
                    <div class="grid grid-cols-1 gap-2">
                        @foreach($categories as $category)
                            <a href="{{ route('blog.index', ['category' => $category->slug]) }}"
                               class="category-item group flex items-center justify-between p-3 rounded-xl bg-gray-800/50 hover:bg-green-600/20 hover:border-green-500/30 border border-transparent hover:border-current text-sm transition-all duration-200 hover:scale-[1.02] hover:shadow-md">
                                <span class="group-hover:text-green-400 transition-colors">{{ $category->name }}</span>
                                <span class="text-xs text-gray-500 group-hover:text-green-300 transition-colors bg-gray-700/50 px-2 py-1 rounded-full">{{ $category->blogs_count }}</span>
                            </a>
                        @endforeach
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-800">
                        <a href="{{ route('blog.index') }}" class="text-xs text-gray-500 hover:text-green-400 transition-colors flex items-center">
                            
                            View all topics
                        </a>
                    </div>
                </div>
            @endif

            {{-- Popular Tags --}}
            @if($tags->count() > 0)
                <div class="sidebar-card bg-gray-900/50 rounded-2xl p-6 border border-gray-800 hover:border-gray-700 transition-all duration-300">
                    <h3 class="text-lg font-bold mb-4 flex items-center justify-between">
                        <span>Popular Tags</span>
                        <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                        </svg>
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($tags as $tag)
                            <a href="{{ route('blog.index', ['tag' => $tag->slug]) }}"
                               class="tag-item inline-flex items-center px-3 py-1.5 bg-gray-800/70 hover:bg-gray-700 text-xs rounded-full border border-gray-700 hover:border-gray-600 transition-all duration-200 hover:scale-105 hover:shadow-sm group">
                                <span class="text-gray-300 group-hover:text-white transition-colors">#{{ $tag->name }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Newsletter Signup --}}
            <div class="sidebar-card bg-gradient-to-br from-green-600/20 to-green-800/20 rounded-2xl p-6 border border-green-500/30 hover:border-green-400/50 transition-all duration-300 group">
                <div class="text-center mb-4">
                    <div class="w-12 h-12 bg-green-600/20 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold group-hover:text-green-400 transition-colors">Stay Updated</h3>
                </div>
                <p class="text-sm text-gray-400 mb-4 text-center">Get the latest insights delivered to your inbox.</p>
                <form class="newsletter-form space-y-3" action="#" method="POST">
                    @csrf
                    <div class="relative">
                        <input type="email"
                               placeholder="Enter your email"
                               class="newsletter-input w-full px-4 py-3 bg-gray-900/80 border border-gray-700 rounded-lg focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 text-sm transition-all duration-200">
                        <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 -translate-y-1/2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                        </svg>
                    </div>
                    <button type="submit"
                            class="newsletter-btn w-full bg-green-600 hover:bg-green-700 text-black font-medium py-3 rounded-lg transition-all duration-200 hover:scale-105 hover:shadow-lg flex items-center justify-center">
                        <span>Subscribe</span>
                        <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </form>
                <p class="text-xs text-gray-500 mt-3 text-center">No spam. Unsubscribe anytime.</p>
            </div>

            {{-- About Sanaa --}}
            <div class="sidebar-card bg-gray-900/50 rounded-2xl p-6 border border-gray-800 hover:border-gray-700 transition-all duration-300 group">
                <div class="text-center mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-600/20 to-green-800/20 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold group-hover:text-green-400 transition-colors">About Sanaa</h3>
                </div>
                <p class="text-sm text-gray-400 leading-relaxed text-center mb-4">
                    Building digital infrastructure solutions across Africa. We believe in the power of minimalist design and profound simplicity.
                </p>
                <div class="text-center">
                    <a href="#" class="inline-flex items-center text-green-400 hover:text-green-300 text-sm font-medium transition-all duration-200 hover:scale-105 group">
                        <span>Learn more</span>
                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                </div>
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

@push('styles')
<style>
/* Enhanced Sidebar Styles */
.sidebar-card {
    backdrop-filter: blur(10px);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.trending-item {
    position: relative;
    overflow: hidden;
}

.trending-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(0, 255, 136, 0.1), transparent);
    transition: left 0.5s;
}

.trending-item:hover::before {
    left: 100%;
}

.trending-number {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.category-item {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.category-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(0, 255, 136, 0.1), rgba(0, 200, 136, 0.05));
    opacity: 0;
    transition: opacity 0.3s ease;
}

.category-item:hover::before {
    opacity: 1;
}

.tag-item {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
}

.tag-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 255, 136, 0.15);
}

.newsletter-input {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    background: rgba(17, 24, 39, 0.8);
}

.newsletter-input:focus {
    background: rgba(17, 24, 39, 1);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 255, 136, 0.2);
}

.newsletter-btn {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.newsletter-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.newsletter-btn:hover::before {
    left: 100%;
}

/* Mobile Enhancements */
@media (max-width: 1024px) {
    .sidebar-card {
        margin-bottom: 1.5rem;
    }

    .trending-item {
        padding: 0.75rem;
    }

    .category-item {
        padding: 0.75rem;
    }
}

/* Accessibility */
@media (prefers-reduced-motion: reduce) {
    .sidebar-card,
    .trending-item,
    .category-item,
    .tag-item,
    .newsletter-input,
    .newsletter-btn {
        transition: none;
    }

    .trending-item::before,
    .category-item::before,
    .newsletter-btn::before {
        display: none;
    }
}

/* Focus states for accessibility */
.sidebar-card:focus-within,
.trending-item:focus,
.category-item:focus,
.tag-item:focus {
    outline: 2px solid rgba(0, 255, 136, 0.5);
    outline-offset: 2px;
}

/* Loading states */
.sidebar-loading {
    opacity: 0.7;
    pointer-events: none;
}

.sidebar-loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 20px;
    margin: -10px 0 0 -10px;
    border: 2px solid rgba(0, 255, 136, 0.3);
    border-top: 2px solid #00ff88;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Pagination mode management
    let paginationMode = localStorage.getItem('blogPaginationMode') || 'infinite';
    let currentPage = {{ $blogs->currentPage() }};
    let isLoading = false;
    let hasMorePages = {{ $blogs->hasMorePages() ? 'true' : 'false' }};

    const articlesContainer = document.getElementById('articles-container');
    const loadingIndicator = document.getElementById('loading-indicator');
    const loadMoreBtn = document.getElementById('load-more-btn');
    const loadMoreContainer = document.getElementById('load-more-container');
    const paginationContainer = document.getElementById('pagination-container');
    const infiniteScrollBtn = document.getElementById('infinite-scroll-btn');
    const paginationBtn = document.getElementById('pagination-btn');
    const articleTemplate = document.getElementById('article-template');

    // Initialize pagination mode
    updatePaginationMode();

    // Pagination mode toggle
    infiniteScrollBtn.addEventListener('click', () => {
        setPaginationMode('infinite');
    });

    paginationBtn.addEventListener('click', () => {
        setPaginationMode('pagination');
    });

    function setPaginationMode(mode) {
        paginationMode = mode;
        localStorage.setItem('blogPaginationMode', mode);
        updatePaginationMode();

        // Track mode preference
        if (typeof gtag !== 'undefined') {
            gtag('event', 'pagination_mode_change', {
                event_category: 'engagement',
                event_label: mode
            });
        }
    }

    function updatePaginationMode() {
        if (paginationMode === 'infinite') {
            infiniteScrollBtn.classList.add('bg-green-600', 'text-black');
            infiniteScrollBtn.classList.remove('bg-gray-700', 'hover:bg-gray-600');
            paginationBtn.classList.remove('bg-green-600', 'text-black');
            paginationBtn.classList.add('bg-gray-700', 'hover:bg-gray-600', 'text-white');

            loadMoreContainer.classList.remove('hidden');
            paginationContainer.classList.add('hidden');

            // Initialize infinite scroll
            initializeInfiniteScroll();
        } else {
            paginationBtn.classList.add('bg-green-600', 'text-black');
            paginationBtn.classList.remove('bg-gray-700', 'hover:bg-gray-600');
            infiniteScrollBtn.classList.remove('bg-green-600', 'text-black');
            infiniteScrollBtn.classList.add('bg-gray-700', 'hover:bg-gray-600', 'text-white');

            loadMoreContainer.classList.add('hidden');
            paginationContainer.classList.remove('hidden');

            // Disable infinite scroll
            if (window.infiniteScrollObserver) {
                window.infiniteScrollObserver.disconnect();
            }
        }
    }

    // Intersection Observer for infinite scroll
    let observer;
    function initializeInfiniteScroll() {
        if (observer) {
            observer.disconnect();
        }

        observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && hasMorePages && !isLoading && paginationMode === 'infinite') {
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

        window.infiniteScrollObserver = observer;
    }

    // Load more button click handler
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', loadMoreArticles);
    }

    function loadMoreArticles() {
        if (isLoading || !hasMorePages) return;

        isLoading = true;
        showLoading();

        const url = new URL(window.location);
        url.searchParams.set('page', currentPage + 1);

        fetch(url.toString(), {
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

                if (!hasMorePages) {
                    loadMoreContainer.classList.add('hidden');
                }
            } else {
                hasMorePages = false;
                loadMoreContainer.classList.add('hidden');
            }
        })
        .catch(error => {
            console.error('Error loading articles:', error);
            hasMorePages = false;
            loadMoreContainer.classList.add('hidden');
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

    // Enhanced Sidebar Interactions
    function initializeSidebar() {
        // Smooth scroll for sidebar links
        const sidebarLinks = document.querySelectorAll('.sidebar-card a');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                // Add loading state
                const card = this.closest('.sidebar-card');
                if (card) {
                    card.classList.add('sidebar-loading');
                    setTimeout(() => {
                        card.classList.remove('sidebar-loading');
                    }, 1000);
                }
            });
        });

        // Enhanced hover effects for trending items
        const trendingItems = document.querySelectorAll('.trending-item');
        trendingItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                const number = this.querySelector('.trending-number');
                if (number) {
                    number.style.transform = 'scale(1.2) rotate(5deg)';
                }
            });

            item.addEventListener('mouseleave', function() {
                const number = this.querySelector('.trending-number');
                if (number) {
                    number.style.transform = 'scale(1) rotate(0deg)';
                }
            });
        });

        // Category items stagger animation
        const categoryItems = document.querySelectorAll('.category-item');
        categoryItems.forEach((item, index) => {
            item.style.animationDelay = `${index * 50}ms`;
            item.classList.add('animate-fade-in');
        });

        // Tag cloud animation
        const tagItems = document.querySelectorAll('.tag-item');
        tagItems.forEach((tag, index) => {
            tag.style.animationDelay = `${index * 30}ms`;
            tag.classList.add('animate-slide-up');
        });

        // Newsletter form enhancement
        const newsletterForm = document.querySelector('.newsletter-form');
        const newsletterInput = document.querySelector('.newsletter-input');
        const newsletterBtn = document.querySelector('.newsletter-btn');

        if (newsletterForm && newsletterInput && newsletterBtn) {
            newsletterInput.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });

            newsletterInput.addEventListener('blur', function() {
                this.parentElement.classList.remove('focused');
            });

            newsletterForm.addEventListener('submit', function(e) {
                e.preventDefault();
                newsletterBtn.innerHTML = '<div class="animate-spin w-4 h-4 border-2 border-black border-t-transparent rounded-full mx-auto"></div>';
                newsletterBtn.disabled = true;

                // Simulate form submission
                setTimeout(() => {
                    newsletterBtn.innerHTML = '✓ Subscribed!';
                    newsletterBtn.classList.add('bg-green-700');
                    newsletterInput.value = '';

                    setTimeout(() => {
                        newsletterBtn.innerHTML = 'Subscribe <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>';
                        newsletterBtn.classList.remove('bg-green-700');
                        newsletterBtn.disabled = false;
                    }, 2000);
                }, 1000);
            });
        }

        // Mobile sidebar enhancements
        function handleMobileSidebar() {
            const sidebar = document.querySelector('.space-y-6.lg\\:sticky');
            if (!sidebar) return;

            if (window.innerWidth < 1024) {
                // Add mobile-specific interactions
                sidebar.classList.add('mobile-sidebar');

                // Add touch feedback
                const cards = sidebar.querySelectorAll('.sidebar-card');
                cards.forEach(card => {
                    card.addEventListener('touchstart', function() {
                        this.style.transform = 'scale(0.98)';
                    });

                    card.addEventListener('touchend', function() {
                        this.style.transform = 'scale(1)';
                    });
                });
            } else {
                sidebar.classList.remove('mobile-sidebar');
            }
        }

        // Initialize mobile handling
        handleMobileSidebar();
        window.addEventListener('resize', handleMobileSidebar);

        // Intersection Observer for sidebar animations
        const sidebarObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '50px'
        });

        const sidebarCards = document.querySelectorAll('.sidebar-card');
        sidebarCards.forEach(card => {
            sidebarObserver.observe(card);
        });

        // Add CSS animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-fade-in {
                animation: fadeInUp 0.6s ease-out forwards;
                opacity: 0;
            }

            .animate-slide-up {
                animation: fadeInUp 0.4s ease-out forwards;
                opacity: 0;
            }

            .animate-in {
                animation: fadeInUp 0.8s ease-out forwards;
            }

            .mobile-sidebar .sidebar-card {
                margin-bottom: 1rem;
                border-radius: 16px;
            }

            .mobile-sidebar .trending-item,
            .mobile-sidebar .category-item {
                padding: 0.75rem;
            }
        `;
        document.head.appendChild(style);
    }

    // Initialize sidebar enhancements
    initializeSidebar();

    // Keyboard shortcuts for pagination
    document.addEventListener('keydown', function(e) {
        // Only trigger if not in input field
        if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') return;

        switch(e.key.toLowerCase()) {
            case 'arrowleft':
                e.preventDefault();
                const prevLink = document.querySelector('a[href*="page="]:not([href*="page={{ $blogs->currentPage() + 1 }}"])');
                if (prevLink) prevLink.click();
                break;
            case 'arrowright':
                e.preventDefault();
                const nextLink = document.querySelector('a[href*="page={{ $blogs->currentPage() + 1 }}"]');
                if (nextLink) nextLink.click();
                break;
        }
    });

    // Performance monitoring for sidebar
    if ('PerformanceObserver' in window) {
        const observer = new PerformanceObserver((list) => {
            list.getEntries().forEach((entry) => {
                if (entry.entryType === 'largest-contentful-paint') {
                    console.log('Sidebar LCP:', entry.startTime);
                }
            });
        });
        observer.observe({ entryTypes: ['largest-contentful-paint'] });
    }
});
</script>
@endpush