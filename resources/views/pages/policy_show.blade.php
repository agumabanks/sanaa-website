@extends('layouts.landing')

@section('title', $seoData['title'] ?? $policy->title . ' | ' . config('app.name'))
@section('description', $seoData['description'] ?? $policy->excerpt)

@push('meta')
@if(isset($seoData))
<!-- SEO Meta Tags -->
<meta name="keywords" content="{{ $policy->meta_keywords ?? '' }}">
<meta name="author" content="Sanaa Team">
<meta name="robots" content="index, follow">
<link rel="canonical" href="{{ $seoData['url'] ?? url()->current() }}">

<!-- Open Graph -->
<meta property="og:title" content="{{ $seoData['title'] ?? $policy->title }}">
<meta property="og:description" content="{{ $seoData['description'] ?? $policy->excerpt }}">
<meta property="og:url" content="{{ $seoData['url'] ?? url()->current() }}">
<meta property="og:type" content="article">
<meta property="og:site_name" content="{{ config('app.name') }}">
@if($policy->updated_at)
<meta property="article:modified_time" content="{{ $policy->updated_at->toISOString() }}">
@endif

<!-- Twitter Card -->
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="{{ $seoData['title'] ?? $policy->title }}">
<meta name="twitter:description" content="{{ $seoData['description'] ?? $policy->excerpt }}">
@endif
@endpush

@push('styles')
<style>
.policy-content {
    line-height: 1.7;
    color: #374151;
}

.policy-content h1,
.policy-content h2,
.policy-content h3,
.policy-content h4,
.policy-content h5,
.policy-content h6 {
    color: #111827;
    font-weight: 600;
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.policy-content h1 { font-size: 2.25rem; }
.policy-content h2 { font-size: 1.875rem; }
.policy-content h3 { font-size: 1.5rem; }

.policy-content ul,
.policy-content ol {
    margin: 1rem 0;
    padding-left: 1.5rem;
}

.policy-content li {
    margin-bottom: 0.5rem;
}

.policy-content a {
    color: #3b82f6;
    text-decoration: underline;
}

.policy-content a:hover {
    color: #1d4ed8;
}

.policy-meta {
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    border-radius: 0.5rem;
    padding: 1rem;
    margin-bottom: 2rem;
}

.policy-breadcrumb {
    margin-bottom: 2rem;
}

.policy-breadcrumb a {
    color: #6b7280;
    text-decoration: none;
}

.policy-breadcrumb a:hover {
    color: #374151;
}

.policy-breadcrumb span {
    color: #9ca3af;
    margin: 0 0.5rem;
}

.related-policies {
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 1px solid #e5e7eb;
}

.policy-card {
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 0.5rem;
    padding: 1.5rem;
    transition: all 0.2s ease;
}

.policy-card:hover {
    border-color: #3b82f6;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.policy-card h3 {
    color: #111827;
    font-size: 1.125rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.policy-card p {
    color: #6b7280;
    font-size: 0.875rem;
    line-height: 1.5;
}

.policy-card a {
    color: #3b82f6;
    text-decoration: none;
    font-weight: 500;
}

.policy-card a:hover {
    color: #1d4ed8;
}
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Breadcrumb -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="policy-breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <a href="{{ route('policies.index') }}">Policies</a>
                <span>/</span>
                <span>{{ $policy->title }}</span>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Policy Header -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 mb-8">
            <div class="flex items-center justify-between mb-4">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                    @if($policy->category === 'legal') bg-blue-100 text-blue-800
                    @elseif($policy->category === 'privacy') bg-green-100 text-green-800
                    @elseif($policy->category === 'licenses') bg-purple-100 text-purple-800
                    @else bg-gray-100 text-gray-800
                    @endif">
                    {{ ucfirst($policy->category) }}
                </span>
                @if($policy->updated_at)
                <span class="text-sm text-gray-500">
                    Last updated: {{ $policy->formatted_date }}
                </span>
                @endif
            </div>

            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $policy->title }}</h1>

            @if($policy->excerpt)
            <p class="text-lg text-gray-600 leading-relaxed">{{ $policy->excerpt }}</p>
            @endif
        </div>

        <!-- Policy Content -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
            <div class="policy-content prose prose-lg max-w-none">
                {!! $policy->content !!}
            </div>
        </div>

        <!-- Related Policies -->
        @php
            $relatedPolicies = \App\Models\Policy::active()
                ->where('category', $policy->category)
                ->where('id', '!=', $policy->id)
                ->orderBy('order')
                ->limit(3)
                ->get();
        @endphp

        @if($relatedPolicies->count() > 0)
        <div class="related-policies">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Related {{ ucfirst($policy->category) }} Policies</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($relatedPolicies as $related)
                <div class="policy-card">
                    <h3>
                        <a href="{{ $related->url }}">{{ $related->title }}</a>
                    </h3>
                    @if($related->excerpt)
                    <p>{{ Str::limit($related->excerpt, 100) }}</p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Back to Policies -->
        <div class="mt-8 text-center">
            <a href="{{ route('policies.index') }}"
               class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-md text-base font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                </svg>
                Back to All Policies
            </a>
        </div>
    </div>
</div>
@endsection
