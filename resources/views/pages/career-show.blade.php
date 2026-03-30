@extends('layouts.landing')

@section('title', $career->meta_title ?: ($career->title . ' | Careers | ' . config('app.name')))

@push('styles')
<style>
    .prose h2 { font-size: 1.5rem; font-weight: 600; margin-top: 2rem; margin-bottom: 1rem; color: #111827; }
    .prose h3 { font-size: 1.25rem; font-weight: 600; margin-top: 1.5rem; margin-bottom: 0.75rem; color: #1f2937; }
    .prose p { margin-bottom: 1rem; color: #4b5563; line-height: 1.75; }
    .prose ul { list-style-type: disc; margin-left: 1.5rem; margin-bottom: 1rem; }
    .prose li { margin-bottom: 0.5rem; color: #4b5563; }
</style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="relative pt-32 pb-12 bg-gradient-to-b from-gray-900 to-gray-800 overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-emerald-500/30 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="mb-8">
                <ol class="flex items-center gap-2 text-sm text-gray-400">
                    <li><a href="{{ route('careers') }}" class="hover:text-white transition-colors">Careers</a></li>
                    <li><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></li>
                    <li class="text-white">{{ Str::limit($career->title, 40) }}</li>
                </ol>
            </nav>

            <div class="flex flex-wrap items-center gap-3 mb-4">
                <span class="px-4 py-1.5 text-sm font-semibold text-emerald-400 bg-emerald-500/20 rounded-full">{{ $career->job_type_label }}</span>
                @if($career->department)
                    <span class="px-4 py-1.5 text-sm font-medium text-blue-300 bg-blue-500/20 rounded-full">{{ $career->department_label }}</span>
                @endif
            </div>

            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-6">{{ $career->title }}</h1>

            <div class="flex flex-wrap items-center gap-6 text-gray-300">
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    {{ $career->location }}
                </span>
                @if($career->salary_range)
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $career->salary_range }}
                    </span>
                @endif
                @if($career->closes_at)
                    <span class="flex items-center gap-2 {{ $career->closes_at->diffInDays(now()) <= 7 ? 'text-yellow-300' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Closes {{ $career->closes_at->format('M d, Y') }}
                    </span>
                @endif
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-16 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-12">
                <!-- Job Details -->
                <div class="lg:col-span-2">
                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl mb-8">
                            <div class="flex items-center gap-3">
                                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <p>{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Description -->
                    <div class="mb-10">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">About the Role</h2>
                        <div class="prose max-w-none">
                            {!! nl2br(e($career->description)) !!}
                        </div>
                    </div>

                    <!-- Requirements -->
                    @if($career->requirements)
                        <div class="mb-10">
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">Requirements</h2>
                            <div class="prose max-w-none">
                                {!! nl2br(e($career->requirements)) !!}
                            </div>
                        </div>
                    @endif

                    <!-- Responsibilities -->
                    @if($career->responsibilities)
                        <div class="mb-10">
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">Responsibilities</h2>
                            <div class="prose max-w-none">
                                {!! nl2br(e($career->responsibilities)) !!}
                            </div>
                        </div>
                    @endif

                    <!-- Benefits -->
                    @if($career->benefits)
                        <div class="mb-10">
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">Benefits</h2>
                            <div class="prose max-w-none">
                                {!! nl2br(e($career->benefits)) !!}
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Apply Card -->
                    <div class="sticky top-28 bg-gray-50 rounded-2xl p-6 border border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Interested in this role?</h3>
                        <p class="text-gray-600 text-sm mb-6">Apply now and take the next step in your career.</p>

                        @if($career->is_active)
                            <a href="{{ route('careers.apply', $career) }}" class="block w-full py-3.5 text-center text-white bg-emerald-500 rounded-xl font-semibold hover:bg-emerald-600 transition-colors">
                                Apply Now
                            </a>
                        @else
                            <div class="py-3.5 text-center text-gray-500 bg-gray-200 rounded-xl font-medium">
                                Position Closed
                            </div>
                        @endif

                        <!-- Share -->
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <p class="text-sm text-gray-500 mb-3">Share this job</p>
                            <div class="flex gap-2">
                                <a href="https://twitter.com/intent/tweet?text={{ urlencode($career->title . ' at ' . config('app.name')) }}&url={{ urlencode(route('careers.show', $career)) }}" target="_blank" class="flex-1 py-2 text-center text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors text-sm">
                                    Twitter
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('careers.show', $career)) }}" target="_blank" class="flex-1 py-2 text-center text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors text-sm">
                                    LinkedIn
                                </a>
                            </div>
                        </div>

                        <!-- Job Info -->
                        <div class="mt-6 pt-6 border-t border-gray-200 space-y-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-gray-200 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Job Type</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $career->job_type_label }}</p>
                                </div>
                            </div>
                            @if($career->department)
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-gray-200 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Department</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $career->department_label }}</p>
                                    </div>
                                </div>
                            @endif
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-gray-200 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Location</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $career->location }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Jobs -->
    @if($relatedJobs->count())
        <section class="py-16 bg-gray-50">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Related Positions</h2>
                <div class="grid md:grid-cols-3 gap-6">
                    @foreach($relatedJobs as $job)
                        <a href="{{ route('careers.show', $job) }}" class="group block bg-white rounded-xl p-6 border border-gray-100 hover:border-emerald-500 hover:shadow-lg transition-all">
                            <span class="inline-block px-3 py-1 text-xs font-semibold text-emerald-700 bg-emerald-100 rounded-full mb-3">{{ $job->job_type_label }}</span>
                            <h3 class="font-semibold text-gray-900 group-hover:text-emerald-600 transition-colors mb-2">{{ $job->title }}</h3>
                            <p class="text-sm text-gray-500 flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                                {{ $job->location }}
                            </p>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
