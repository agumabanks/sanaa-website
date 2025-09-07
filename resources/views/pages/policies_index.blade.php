@extends('layouts.landing')

@section('title', 'Policies & Legal Documents | ' . config('app.name'))
@section('description', 'Comprehensive collection of our policies, terms, privacy notices, and legal documents.')

@push('styles')
<style>
.policy-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

.policy-card {
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 0.75rem;
    padding: 2rem;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.policy-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #3b82f6, #8b5cf6);
}

.policy-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    border-color: #3b82f6;
}

.policy-card.legal::before { background: linear-gradient(90deg, #3b82f6, #1d4ed8); }
.policy-card.privacy::before { background: linear-gradient(90deg, #10b981, #059669); }
.policy-card.licenses::before { background: linear-gradient(90deg, #8b5cf6, #7c3aed); }
.policy-card.corporate::before { background: linear-gradient(90deg, #f59e0b, #d97706); }

.policy-icon {
    width: 3rem;
    height: 3rem;
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1rem;
}

.policy-card h3 {
    font-size: 1.25rem;
    font-weight: 600;
    color: #111827;
    margin-bottom: 0.5rem;
}

.policy-card p {
    color: #6b7280;
    line-height: 1.6;
    margin-bottom: 1rem;
}

.policy-link {
    color: #3b82f6;
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    transition: color 0.2s ease;
}

.policy-link:hover {
    color: #1d4ed8;
}

.policy-link svg {
    width: 1rem;
    height: 1rem;
    margin-left: 0.5rem;
    transition: transform 0.2s ease;
}

.policy-link:hover svg {
    transform: translateX(2px);
}

.category-filter {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 2rem;
}

.category-btn {
    padding: 0.5rem 1rem;
    border: 1px solid #d1d5db;
    border-radius: 0.5rem;
    background: white;
    color: #6b7280;
    text-decoration: none;
    transition: all 0.2s ease;
    font-size: 0.875rem;
    font-weight: 500;
}

.category-btn:hover,
.category-btn.active {
    background: #3b82f6;
    color: white;
    border-color: #3b82f6;
}

.search-form {
    max-width: 400px;
    margin-bottom: 2rem;
}

.search-input {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid #d1d5db;
    border-radius: 0.5rem;
    font-size: 1rem;
}

.search-input:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

@media (max-width: 768px) {
    .policy-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .policy-card {
        padding: 1.5rem;
    }
}
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Policies & Legal Documents</h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Comprehensive collection of our policies, terms, privacy notices, and legal documents.
                    Find the information you need about our services and practices.
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Filters -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <!-- Category Filters -->
            <div class="category-filter">
                <a href="{{ route('policies.index') }}"
                   class="category-btn {{ !$category ? 'active' : '' }}">
                    All Policies
                </a>
                @foreach($categories as $catKey => $catName)
                <a href="{{ route('policies.index', ['category' => $catKey]) }}"
                   class="category-btn {{ $category === $catKey ? 'active' : '' }}">
                    {{ $catName }}
                </a>
                @endforeach
            </div>

            <!-- Search -->
            <form method="GET" class="search-form">
                <input type="text"
                       name="search"
                       value="{{ $search }}"
                       placeholder="Search policies..."
                       class="search-input">
            </form>
        </div>

        <!-- Results Info -->
        @if($search || $category)
        <div class="mb-6">
            <p class="text-gray-600">
                @if($search)
                    Showing results for "<strong>{{ $search }}</strong>"
                    @if($category)
                        in {{ $categories[$category] }}
                    @endif
                @elseif($category)
                    Showing {{ $categories[$category] }} policies
                @endif
                <a href="{{ route('policies.index') }}" class="text-blue-600 hover:text-blue-800 ml-2">
                    Clear filters
                </a>
            </p>
        </div>
        @endif

        <!-- Policies Grid -->
        @if($policies->count() > 0)
        <div class="policy-grid">
            @foreach($policies as $category => $categoryPolicies)
                @foreach($categoryPolicies as $policy)
                <div class="policy-card {{ $category }}">
                    <div class="policy-icon
                        @if($category === 'legal') bg-blue-100 text-blue-600
                        @elseif($category === 'privacy') bg-green-100 text-green-600
                        @elseif($category === 'licenses') bg-purple-100 text-purple-600
                        @else bg-orange-100 text-orange-600
                        @endif">
                        @if($category === 'legal')
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                            </svg>
                        @elseif($category === 'privacy')
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                            </svg>
                        @elseif($category === 'licenses')
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        @else
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h4a2 2 0 110 4H8a2 2 0 01-2-2z" clip-rule="evenodd"/>
                            </svg>
                        @endif
                    </div>

                    <h3>{{ $policy->title }}</h3>

                    @if($policy->excerpt)
                    <p>{{ Str::limit($policy->excerpt, 120) }}</p>
                    @endif

                    <a href="{{ $policy->url }}" class="policy-link">
                        Read More
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                </div>
                @endforeach
            @endforeach
        </div>
        @else
        <!-- No Results -->
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No policies found</h3>
            <p class="mt-1 text-sm text-gray-500">
                @if($search || $category)
                    Try adjusting your search or filter criteria.
                @else
                    No policies are currently available.
                @endif
            </p>
            @if($search || $category)
            <div class="mt-6">
                <a href="{{ route('policies.index') }}" class="text-blue-600 hover:text-blue-500">
                    View all policies →
                </a>
            </div>
            @endif
        </div>
        @endif
    </div>
</div>
@endsection