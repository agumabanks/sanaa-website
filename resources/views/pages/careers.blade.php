@extends('layouts.landing')

@section('title', 'Careers | ' . config('app.name'))
@section('seo_title', 'Careers | Sanaa Co. — Join the Team Building Africa\'s Digital Economy')
@section('seo_description', 'Join Sanaa Co. and help build finance, commerce, and logistics tools for African businesses. View open positions in engineering, design, operations, and more.')
@section('seo_keywords', 'Sanaa careers, Sanaa jobs, Uganda tech jobs, fintech careers Africa, Sanaa hiring, software engineer Uganda')

@section('content')
    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 bg-gradient-to-b from-gray-900 via-gray-900 to-black overflow-hidden">
        <!-- Background Effects -->
        <div class="absolute inset-0 opacity-30">
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-emerald-500/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <span class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-emerald-400 bg-emerald-500/10 rounded-full mb-6">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    We're Hiring
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
                    Build the Future with <span class="text-emerald-400">Sanaa</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-400 mb-10">
                    Join the team building finance, commerce, logistics, and infrastructure tools for African business.
                </p>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-4 max-w-md mx-auto">
                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-4">
                        <div class="text-2xl md:text-3xl font-bold text-white">{{ $stats['total_positions'] }}</div>
                        <div class="text-sm text-gray-400">Open Positions</div>
                    </div>
                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-4">
                        <div class="text-2xl md:text-3xl font-bold text-white">{{ $stats['departments'] }}</div>
                        <div class="text-sm text-gray-400">Departments</div>
                    </div>
                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-4">
                        <div class="text-2xl md:text-3xl font-bold text-white">{{ $stats['locations'] }}</div>
                        <div class="text-sm text-gray-400">Locations</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filters & Jobs Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Filter Bar -->
            <form method="GET" action="{{ route('careers') }}" class="bg-gray-50 rounded-2xl p-6 mb-10">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Search -->
                    <div class="relative">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search jobs..."
                            class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                        >
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>

                    <!-- Department -->
                    <select name="department" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white">
                        <option value="">All Departments</option>
                        @foreach($departments as $key => $label)
                            <option value="{{ $key }}" {{ request('department') === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>

                    <!-- Location -->
                    <select name="location" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white">
                        <option value="">All Locations</option>
                        @foreach($locations as $location)
                            <option value="{{ $location }}" {{ request('location') === $location ? 'selected' : '' }}>{{ $location }}</option>
                        @endforeach
                    </select>

                    <!-- Job Type -->
                    <select name="job_type" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white">
                        <option value="">All Job Types</option>
                        @foreach($jobTypes as $key => $label)
                            <option value="{{ $key }}" {{ request('job_type') === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end mt-4 gap-2">
                    @if(request()->hasAny(['search', 'department', 'location', 'job_type']))
                        <a href="{{ route('careers') }}" class="px-4 py-2 text-gray-600 hover:text-gray-900">Clear filters</a>
                    @endif
                    <button type="submit" class="px-6 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition-colors font-medium">
                        Search Jobs
                    </button>
                </div>
            </form>

            <!-- Job Listings -->
            @if($careers->count())
                <div class="grid gap-4">
                    @foreach($careers as $career)
                        <a href="{{ route('careers.show', $career) }}" class="group block bg-white border border-gray-200 rounded-2xl p-6 hover:border-emerald-500 hover:shadow-lg transition-all duration-300">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <div class="flex-1">
                                    <div class="flex flex-wrap items-center gap-2 mb-2">
                                        <span class="px-3 py-1 text-xs font-semibold text-emerald-700 bg-emerald-100 rounded-full">{{ $career->job_type_label }}</span>
                                        @if($career->department)
                                            <span class="px-3 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded-full">{{ $career->department_label }}</span>
                                        @endif
                                    </div>
                                    <h3 class="text-xl font-semibold text-gray-900 group-hover:text-emerald-600 transition-colors">{{ $career->title }}</h3>
                                    <p class="text-gray-600 mt-2 line-clamp-2">{{ Str::limit(strip_tags($career->description), 150) }}</p>
                                    <div class="flex flex-wrap items-center gap-4 mt-4 text-sm text-gray-500">
                                        <span class="flex items-center gap-1.5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            {{ $career->location }}
                                        </span>
                                        @if($career->salary_range)
                                            <span class="flex items-center gap-1.5">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                {{ $career->salary_range }}
                                            </span>
                                        @endif
                                        @if($career->closes_at)
                                            <span class="flex items-center gap-1.5 {{ $career->closes_at->diffInDays(now()) <= 7 ? 'text-red-500' : '' }}">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                Closes {{ $career->closes_at->format('M d, Y') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-shrink-0">
                                    <span class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-100 text-gray-700 rounded-full text-sm font-medium group-hover:bg-emerald-500 group-hover:text-white transition-colors">
                                        View Details
                                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-10">
                    {{ $careers->links() }}
                </div>
            @else
                <div class="text-center py-16">
                    <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No open positions</h3>
                    <p class="text-gray-600 max-w-md mx-auto">
                        @if(request()->hasAny(['search', 'department', 'location', 'job_type']))
                            No jobs match your current filters. Try adjusting your search criteria.
                        @else
                            We don't have any open positions right now, but we're always looking for talented people. Check back soon or send us your resume.
                        @endif
                    </p>
                    @if(request()->hasAny(['search', 'department', 'location', 'job_type']))
                        <a href="{{ route('careers') }}" class="inline-flex items-center gap-2 mt-6 px-6 py-3 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition-colors font-medium">
                            Clear Filters
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </section>

    <!-- Why Join Us Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Why Join Sanaa?</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">We're building something special, and we want you to be part of it.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                    <div class="w-14 h-14 rounded-xl bg-emerald-100 flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Impactful Work</h3>
                    <p class="text-gray-600">Build technology that transforms businesses and improves lives across Africa.</p>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                    <div class="w-14 h-14 rounded-xl bg-blue-100 flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Continuous Learning</h3>
                    <p class="text-gray-600">Access to learning resources, conferences, and mentorship to grow your skills.</p>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                    <div class="w-14 h-14 rounded-xl bg-purple-100 flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Collaborative Culture</h3>
                    <p class="text-gray-600">Work with talented, diverse teams who support each other and celebrate wins together.</p>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                    <div class="w-14 h-14 rounded-xl bg-orange-100 flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Flexible Work</h3>
                    <p class="text-gray-600">Remote-friendly environment with flexible hours to maintain work-life balance.</p>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                    <div class="w-14 h-14 rounded-xl bg-pink-100 flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Health & Wellness</h3>
                    <p class="text-gray-600">Comprehensive health coverage and wellness programs to keep you at your best.</p>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                    <div class="w-14 h-14 rounded-xl bg-cyan-100 flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Growth Opportunities</h3>
                    <p class="text-gray-600">Clear career paths and opportunities to take on new challenges and responsibilities.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-emerald-600 to-emerald-700">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Don't see the right role?</h2>
            <p class="text-lg text-emerald-100 mb-8">
                We're always looking for talented people. Send us your resume and we'll reach out when a matching opportunity opens up.
            </p>
            <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-white text-emerald-600 rounded-full font-semibold hover:bg-gray-100 transition-colors">
                Get in Touch
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </section>
@endsection
