<x-admin-dashboard-layout title="Applications - {{ $career->title }}">
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.careers.index') }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            Applications for {{ Str::limit($career->title, 40) }}
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500">Review and manage job applications</p>
            </div>
            <a href="{{ route('admin.careers.edit', $career) }}" class="btn-secondary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Job
            </a>
        </div>

        <!-- Filter -->
        <form method="GET" class="content-card p-4">
            <div class="flex flex-col md:flex-row gap-4">
                <select name="status" class="input-field w-full md:w-48">
                    <option value="">All Statuses</option>
                    @foreach($statuses as $key => $label)
                        <option value="{{ $key }}" {{ request('status') === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn-secondary">Filter</button>
            </div>
        </form>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Applications List -->
        <div class="content-card">
            @if($applications->count())
                <div class="divide-y divide-gray-100">
                    @foreach($applications as $application)
                        <div class="p-5 hover:bg-gray-50 apple-transition" x-data="{ expanded: false }">
                            <div class="flex items-start gap-4">
                                <!-- Avatar -->
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-semibold flex-shrink-0">
                                    {{ strtoupper(substr($application->first_name, 0, 1) . substr($application->last_name, 0, 1)) }}
                                </div>

                                <div class="flex-1 min-w-0">
                                    <div class="flex items-start justify-between gap-4">
                                        <div>
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="badge bg-{{ $application->status_color }}-50 text-{{ $application->status_color }}-700">
                                                    {{ $application->status_label }}
                                                </span>
                                                <span class="text-xs text-gray-500">{{ $application->created_at->diffForHumans() }}</span>
                                            </div>
                                            <h3 class="font-semibold text-gray-900">{{ $application->full_name }}</h3>
                                            <p class="text-sm text-gray-500">{{ $application->email }}</p>
                                        </div>
                                        <div class="flex items-center gap-2 flex-shrink-0">
                                            @if($application->resume_path)
                                                <a href="{{ Storage::url($application->resume_path) }}" target="_blank" class="p-2 rounded-lg hover:bg-blue-50 text-gray-500 hover:text-blue-600 apple-transition" title="Download Resume">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                    </svg>
                                                </a>
                                            @endif
                                            @if($application->linkedin_url)
                                                <a href="{{ $application->linkedin_url }}" target="_blank" class="p-2 rounded-lg hover:bg-blue-50 text-gray-500 hover:text-blue-600 apple-transition" title="LinkedIn Profile">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                                    </svg>
                                                </a>
                                            @endif
                                            <button @click="expanded = !expanded" class="p-2 rounded-lg hover:bg-gray-100 text-gray-500 apple-transition">
                                                <svg class="w-4 h-4 transition-transform" :class="expanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-4 mt-2 text-xs text-gray-500">
                                        @if($application->phone)
                                            <span class="flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                </svg>
                                                {{ $application->phone }}
                                            </span>
                                        @endif
                                        @if($application->location)
                                            <span class="flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                                {{ $application->location }}
                                            </span>
                                        @endif
                                        @if($application->source)
                                            <span class="flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                                </svg>
                                                {{ ucfirst($application->source) }}
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Expanded Details -->
                                    <div x-show="expanded" x-collapse class="mt-4 pt-4 border-t border-gray-100">
                                        @if($application->cover_letter)
                                            <div class="mb-4">
                                                <h4 class="text-sm font-semibold text-gray-700 mb-2">Cover Letter</h4>
                                                <div class="text-sm text-gray-600 whitespace-pre-wrap bg-gray-50 p-4 rounded-lg">{{ $application->cover_letter }}</div>
                                            </div>
                                        @endif

                                        <!-- Status Update Form -->
                                        <form method="POST" action="{{ route('admin.careers.applications.update', [$career, $application]) }}" class="flex flex-col md:flex-row gap-4 mt-4">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" class="input-field w-full md:w-48">
                                                @foreach($statuses as $key => $label)
                                                    <option value="{{ $key }}" {{ $application->status === $key ? 'selected' : '' }}>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                            <input type="text" name="notes" value="{{ $application->notes }}" placeholder="Add a note..." class="input-field flex-1">
                                            <button type="submit" class="btn-primary">Update Status</button>
                                        </form>

                                        @if($application->reviewer)
                                            <p class="text-xs text-gray-500 mt-2">Last reviewed by {{ $application->reviewer->name }} on {{ $application->reviewed_at->format('M d, Y') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="px-5 py-4 border-t border-gray-100 bg-gray-50/50">
                    {{ $applications->links() }}
                </div>
            @else
                <div class="p-12 text-center">
                    <div class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">No applications yet</h3>
                    <p class="text-gray-500 mt-1">Applications will appear here once candidates apply</p>
                </div>
            @endif
        </div>
    </div>
</x-admin-dashboard-layout>
