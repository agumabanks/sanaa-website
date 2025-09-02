<x-dashboard-layout title="Dashboard">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @php(
      $postsTotal = \App\Models\Blog::count()
    )
    @php(
      $postsDraft = \App\Models\Blog::where('status','draft')->count()
    )
    @php(
      $postsPublished = \App\Models\Blog::where('status','published')->count()
    )
    @php(
      $viewsTotal = \App\Models\Blog::sum('views')
    )
    @php(
      $usersTotal = \App\Models\User::count() 
    )

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <!-- Quick stats -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                <div class="bg-white rounded-2xl border border-gray-200 ring-1 ring-black/5 shadow-sm p-5">
                    <div class="text-sm text-gray-500">Posts</div>
                    <div class="mt-1 text-2xl font-semibold text-gray-900 tracking-tight">{{ number_format($postsTotal) }}</div>
                </div>
                <div class="bg-white rounded-2xl border border-gray-200 ring-1 ring-black/5 shadow-sm p-5">
                    <div class="text-sm text-gray-500">Drafts</div>
                    <div class="mt-1 text-2xl font-semibold text-gray-900 tracking-tight">{{ number_format($postsDraft) }}</div>
                </div>
                <div class="bg-white rounded-2xl border border-gray-200 ring-1 ring-black/5 shadow-sm p-5">
                    <div class="text-sm text-gray-500">Published</div>
                    <div class="mt-1 text-2xl font-semibold text-gray-900 tracking-tight">{{ number_format($postsPublished) }}</div>
                </div>
                <div class="bg-white rounded-2xl border border-gray-200 ring-1 ring-black/5 shadow-sm p-5">
                    <div class="text-sm text-gray-500">Total Views</div>
                    <div class="mt-1 text-2xl font-semibold text-gray-900 tracking-tight">{{ number_format($viewsTotal) }}</div>
                </div>
                <div class="bg-white rounded-2xl border border-gray-200 ring-1 ring-black/5 shadow-sm p-5">
                    <div class="text-sm text-gray-500">Users</div>
                    <div class="mt-1 text-2xl font-semibold text-gray-900 tracking-tight">{{ number_format($usersTotal) }}</div>
                </div>
            </div>

            <!-- Quick actions -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('dashboard.blog') }}#create-post" class="group bg-white rounded-2xl border border-gray-200 ring-1 ring-black/5 shadow-sm p-5 flex items-center justify-between hover:border-gray-300 hover:shadow-md transition-all">
                    <div>
                        <div class="text-sm text-gray-500">Create</div>
                        <div class="text-lg font-semibold text-gray-900 tracking-tight">New Post</div>
                    </div>
                    <div class="rounded-lg bg-black text-white p-2">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M19 13H13v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                    </div>
                </a>
                <a href="{{ route('dashboard.users') }}" class="group bg-white rounded-2xl border border-gray-200 ring-1 ring-black/5 shadow-sm p-5 flex items-center justify-between hover:border-gray-300 hover:shadow-md transition-all">
                    <div>
                        <div class="text-sm text-gray-500">Manage</div>
                        <div class="text-lg font-semibold text-gray-900 tracking-tight">Users</div>
                    </div>
                    <div class="rounded-lg bg-black text-white p-2">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                    </div>
                </a>
                <a href="{{ route('dashboard.categories') }}" class="group bg-white rounded-2xl border border-gray-200 ring-1 ring-black/5 shadow-sm p-5 flex items-center justify-between hover:border-gray-300 hover:shadow-md transition-all">
                    <div>
                        <div class="text-sm text-gray-500">Manage</div>
                        <div class="text-lg font-semibold text-gray-900 tracking-tight">Categories</div>
                    </div>
                    <div class="rounded-lg bg-black text-white p-2">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M3 5h8v8H3V5zm10 0h8v8h-8V5zM3 15h8v4H3v-4zm10 0h8v4h-8v-4z"/></svg>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-dashboard-layout>
