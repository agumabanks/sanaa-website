<x-admin-dashboard-layout title="Categories">
    <x-slot name="header">Categories & Business Types</x-slot>

    @php
        $blogCategories = \App\Models\BlogCategory::withCount('blogs')->orderBy('name')->get();
        $businessCategories = \App\Models\BusinessCategory::orderBy('name')->get();
    @endphp

    <div class="space-y-8">
        <!-- Blog Categories Section -->
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">Blog Categories</h2>
                    <p class="text-gray-500 mt-1">Organize your blog posts into categories</p>
                </div>
                <button onclick="document.getElementById('create-blog-cat-modal').classList.remove('hidden')" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Category
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($blogCategories as $category)
                    <div class="content-card p-5 group hover:ring-2 hover:ring-blue-500/20 apple-transition">
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background-color: {{ $category->color ?? '#E5E7EB' }}20;">
                                    <svg class="w-5 h-5" style="color: {{ $category->color ?? '#6B7280' }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">{{ $category->name }}</h3>
                                    <p class="text-sm text-gray-500">{{ $category->blogs_count }} posts</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 apple-transition">
                                <a href="{{ route('blog.category', $category->slug) }}" target="_blank" class="p-2 rounded-lg hover:bg-gray-100 text-gray-400 hover:text-gray-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        @if($category->description)
                            <p class="text-sm text-gray-500 mt-3 line-clamp-2">{{ $category->description }}</p>
                        @endif
                    </div>
                @empty
                    <div class="col-span-full content-card p-8 text-center">
                        <p class="text-gray-500">No blog categories yet</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Business Categories Section -->
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">Business Types</h2>
                    <p class="text-gray-500 mt-1">Define your business categories and industry types</p>
                </div>
                <button onclick="document.getElementById('create-business-cat-modal').classList.remove('hidden')" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Business Type
                </button>
            </div>

            <div class="content-card overflow-hidden">
                @if($businessCategories->count())
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-100">
                                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Slug</th>
                                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Description</th>
                                    <th class="text-right px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($businessCategories as $cat)
                                    <tr class="table-row">
                                        <td class="px-6 py-4">
                                            <span class="font-medium text-gray-900">{{ $cat->name }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <code class="text-sm text-gray-600 bg-gray-100 px-2 py-1 rounded">{{ $cat->slug }}</code>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ Str::limit($cat->description, 50) }}</td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-end gap-2">
                                                <button onclick="editBusinessCat({{ json_encode($cat) }})" class="p-2 rounded-lg hover:bg-blue-50 text-gray-500 hover:text-blue-600 apple-transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-8 text-center">
                        <p class="text-gray-500">No business types yet</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Tags Section -->
        @php
            $tags = \App\Models\BlogTag::withCount('blogs')->orderByDesc('blogs_count')->limit(50)->get();
        @endphp
        <div class="space-y-6">
            <div>
                <h2 class="text-xl font-semibold text-gray-900">Popular Tags</h2>
                <p class="text-gray-500 mt-1">Most used tags across your blog posts</p>
            </div>

            <div class="content-card p-6">
                @if($tags->count())
                    <div class="flex flex-wrap gap-2">
                        @foreach($tags as $tag)
                            <a href="{{ route('blog.tag', $tag->slug) }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-full text-sm apple-transition">
                                <span>#{{ $tag->name }}</span>
                                <span class="text-xs text-gray-500">({{ $tag->blogs_count }})</span>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center">No tags yet</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Create Blog Category Modal -->
    <div id="create-blog-cat-modal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/50" onclick="document.getElementById('create-blog-cat-modal').classList.add('hidden')"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md apple-shadow-lg" onclick="event.stopPropagation()">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900">Add Blog Category</h3>
                </div>
                <form method="POST" action="{{ route('dashboard.category.store') }}" class="p-6 space-y-5">
                    @csrf
                    <input type="hidden" name="type" value="blog">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                        <input type="text" name="name" required class="input-field" placeholder="Category name">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea name="description" rows="2" class="input-field" placeholder="Optional description"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Color</label>
                        <input type="color" name="color" value="#3B82F6" class="h-10 w-20 rounded border border-gray-300">
                    </div>
                    <div class="flex items-center justify-end gap-3 pt-4">
                        <button type="button" onclick="document.getElementById('create-blog-cat-modal').classList.add('hidden')" class="btn-secondary">Cancel</button>
                        <button type="submit" class="btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Create Business Category Modal -->
    <div id="create-business-cat-modal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/50" onclick="document.getElementById('create-business-cat-modal').classList.add('hidden')"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md apple-shadow-lg" onclick="event.stopPropagation()">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900">Add Business Type</h3>
                </div>
                <form method="POST" action="{{ route('dashboard.category.store') }}" class="p-6 space-y-5">
                    @csrf
                    <input type="hidden" name="type" value="business">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                        <input type="text" name="name" required class="input-field" placeholder="Business type name">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea name="description" rows="2" class="input-field" placeholder="Optional description"></textarea>
                    </div>
                    <div class="flex items-center justify-end gap-3 pt-4">
                        <button type="button" onclick="document.getElementById('create-business-cat-modal').classList.add('hidden')" class="btn-secondary">Cancel</button>
                        <button type="submit" class="btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function editBusinessCat(cat) {
            alert('Edit functionality for business category: ' + cat.name);
        }
    </script>
    @endpush
</x-admin-dashboard-layout>
