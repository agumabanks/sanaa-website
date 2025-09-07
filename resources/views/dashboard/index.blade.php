<x-dashboard-layout title="Dashboard">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if(Auth::check() && Auth::user()->isAdmin())
        @php($postsTotal = \App\Models\Blog::count())
        @php($postsDraft = \App\Models\Blog::where('status','draft')->count())
        @php($postsPublished = \App\Models\Blog::where('status','published')->count())
        @php($viewsTotal = \App\Models\Blog::sum('views'))
        @php($usersTotal = \App\Models\User::count())

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
    @else
        @php($myPostsTotal = \App\Models\Blog::where('author_id', auth()->id())->count())
        @php($myPostsDraft = \App\Models\Blog::where('author_id', auth()->id())->where('status','draft')->count())
        @php($myPostsPublished = \App\Models\Blog::where('author_id', auth()->id())->where('status','published')->count())
        @php($myViewsTotal = \App\Models\Blog::where('author_id', auth()->id())->sum('views'))

        <div class="py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
                <!-- My Blog stats -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-white rounded-2xl border border-gray-200 ring-1 ring-black/5 shadow-sm p-5">
                        <div class="text-sm text-gray-500">My Posts</div>
                        <div class="mt-1 text-2xl font-semibold text-gray-900 tracking-tight">{{ number_format($myPostsTotal) }}</div>
                    </div>
                    <div class="bg-white rounded-2xl border border-gray-200 ring-1 ring-black/5 shadow-sm p-5">
                        <div class="text-sm text-gray-500">My Drafts</div>
                        <div class="mt-1 text-2xl font-semibold text-gray-900 tracking-tight">{{ number_format($myPostsDraft) }}</div>
                    </div>
                    <div class="bg-white rounded-2xl border border-gray-200 ring-1 ring-black/5 shadow-sm p-5">
                        <div class="text-sm text-gray-500">My Published</div>
                        <div class="mt-1 text-2xl font-semibold text-gray-900 tracking-tight">{{ number_format($myPostsPublished) }}</div>
                    </div>
                    <div class="bg-white rounded-2xl border border-gray-200 ring-1 ring-black/5 shadow-sm p-5">
                        <div class="text-sm text-gray-500">My Total Views</div>
                        <div class="mt-1 text-2xl font-semibold text-gray-900 tracking-tight">{{ number_format($myViewsTotal) }}</div>
                    </div>
                </div>

                <!-- Quick actions -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('dashboard.stats') }}" class="group bg-white rounded-2xl border border-gray-200 ring-1 ring-black/5 shadow-sm p-5 flex items-center justify-between hover:border-gray-300 hover:shadow-md transition-all">
                        <div>
                            <div class="text-sm text-gray-500">View</div>
                            <div class="text-lg font-semibold text-gray-900 tracking-tight">My Blog Stats</div>
                        </div>
                        <div class="rounded-lg bg-black text-white p-2">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M3 13h8V3H3v10zm10 0h8V11h-8v10zm0-18v6h8V3h-8zM3 21h8v-6H3v6z"/></svg>
                        </div>
                    </a>
                    <a href="{{ route('blog.index') }}" class="group bg-white rounded-2xl border border-gray-200 ring-1 ring-black/5 shadow-sm p-5 flex items-center justify-between hover:border-gray-300 hover:shadow-md transition-all">
                        <div>
                            <div class="text-sm text-gray-500">Explore</div>
                            <div class="text-lg font-semibold text-gray-900 tracking-tight">Stories</div>
                        </div>
                        <div class="rounded-lg bg-black text-white p-2">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2V4a2 2 0 00-2-2z"/></svg>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    @endif
</x-dashboard-layout>
