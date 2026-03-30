<x-admin-dashboard-layout title="Pages">
    <x-slot name="header">Website Pages</x-slot>

    @php
        $pages = \App\Models\SitePage::orderBy('title')->get();
    @endphp

    <div class="space-y-6">
        <!-- Header Actions -->
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500">Manage website pages and content</p>
            </div>
            <a href="{{ route('dashboard.pages.create') }}" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                New Page
            </a>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="stat-card">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-semibold text-gray-900">{{ $pages->count() }}</p>
                        <p class="text-sm text-gray-500">Total Pages</p>
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-green-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-semibold text-gray-900">{{ $pages->where('status', true)->count() }}</p>
                        <p class="text-sm text-gray-500">Published</p>
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-orange-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-semibold text-gray-900">{{ $pages->where('status', false)->count() }}</p>
                        <p class="text-sm text-gray-500">Drafts</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search -->
        <div class="content-card p-4">
            <div class="relative">
                <input type="text" id="page-search" placeholder="Search pages..." class="input-field pl-10">
                <svg class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </div>

        <!-- Pages Table -->
        <div class="content-card overflow-hidden">
            @if($pages->count())
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Page</th>
                                <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">URL</th>
                                <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Updated</th>
                                <th class="text-right px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100" id="pages-list">
                            @foreach($pages as $page)
                                <tr class="table-row page-item" data-title="{{ strtolower($page->title) }}">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center">
                                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-900">{{ $page->title }}</p>
                                                @if($page->meta_description)
                                                    <p class="text-xs text-gray-500 truncate max-w-xs">{{ Str::limit($page->meta_description, 50) }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <code class="text-sm text-gray-600 bg-gray-100 px-2 py-1 rounded">/p/{{ $page->slug }}</code>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="badge {{ $page->status ? 'badge-success' : 'badge-warning' }}">
                                            {{ $page->status ? 'Published' : 'Draft' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $page->updated_at->format('M d, Y') }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('page.show', $page->slug) }}" target="_blank" class="p-2 rounded-lg hover:bg-gray-100 text-gray-500 hover:text-gray-700 apple-transition" title="View">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                                </svg>
                                            </a>
                                            <a href="{{ route('dashboard.pages.edit', $page) }}" class="p-2 rounded-lg hover:bg-blue-50 text-gray-500 hover:text-blue-600 apple-transition" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            <form method="POST" action="{{ route('dashboard.pages.destroy', $page) }}" onsubmit="return confirm('Delete this page?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 rounded-lg hover:bg-red-50 text-gray-500 hover:text-red-600 apple-transition" title="Delete">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-12 text-center">
                    <div class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">No pages yet</h3>
                    <p class="text-gray-500 mt-1">Create your first website page</p>
                    <a href="{{ route('dashboard.pages.create') }}" class="btn-primary mt-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Create Page
                    </a>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        const searchInput = document.getElementById('page-search');
        const pagesList = document.getElementById('pages-list');

        searchInput?.addEventListener('input', () => {
            const searchTerm = searchInput.value.toLowerCase();
            pagesList?.querySelectorAll('.page-item').forEach(item => {
                const title = item.dataset.title || '';
                item.style.display = title.includes(searchTerm) ? '' : 'none';
            });
        });
    </script>
    @endpush
</x-admin-dashboard-layout>
