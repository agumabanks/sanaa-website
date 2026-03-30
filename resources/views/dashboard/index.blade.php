<x-dashboard-layout title="Dashboard">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            Dashboard
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
                <div class="flex items-center justify-between">
                    <h3 class="text-2xl font-bold text-gray-900">Admin Overview</h3>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('dashboard.blog') }}" class="px-4 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium">Manage Blog</a>
                    </div>
                </div>

                <!-- Quick stats -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg p-6 text-white">
                        <div class="text-sm opacity-90">Total Posts</div>
                        <div class="mt-2 text-3xl font-bold">{{ number_format($postsTotal) }}</div>
                    </div>
                    <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl shadow-lg p-6 text-white">
                        <div class="text-sm opacity-90">Drafts</div>
                        <div class="mt-2 text-3xl font-bold">{{ number_format($postsDraft) }}</div>
                    </div>
                    <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl shadow-lg p-6 text-white">
                        <div class="text-sm opacity-90">Published</div>
                        <div class="mt-2 text-3xl font-bold">{{ number_format($postsPublished) }}</div>
                    </div>
                    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-lg p-6 text-white">
                        <div class="text-sm opacity-90">Total Views</div>
                        <div class="mt-2 text-3xl font-bold">{{ number_format($viewsTotal) }}</div>
                    </div>
                    <div class="bg-gradient-to-br from-pink-500 to-pink-600 rounded-2xl shadow-lg p-6 text-white">
                        <div class="text-sm opacity-90">Total Users</div>
                        <div class="mt-2 text-3xl font-bold">{{ number_format($usersTotal) }}</div>
                    </div>
                </div>

                <!-- Analytics Chart -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Traffic Overview</h3>
                        <select class="text-sm border-gray-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                            <option>Last 7 Days</option>
                            <option>Last 30 Days</option>
                            <option>This Year</option>
                        </select>
                    </div>
                    <div class="h-80 w-full">
                        <canvas id="trafficChart"></canvas>
                    </div>
                </div>

                <!-- Recent Comments -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-900">Recent Comments</h3>
                            <a href="#" class="text-sm text-emerald-600 hover:text-emerald-700 font-medium">View All</a>
                        </div>
                        <div class="space-y-6">
                            @php($comments = \App\Models\BlogComment::with(['user', 'blog'])->latest()->take(5)->get())
                            @forelse($comments as $comment)
                                <div class="flex gap-4">
                                    <img src="{{ $comment->user->profile_photo_url }}" alt="{{ $comment->user->name }}" class="w-10 h-10 rounded-full bg-gray-100 object-cover flex-shrink-0">
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between">
                                            <p class="text-sm font-medium text-gray-900 truncate">{{ $comment->user->name }}</p>
                                            <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-sm text-gray-600 line-clamp-2 mt-1">{{ $comment->content }}</p>
                                        <div class="mt-2 flex items-center gap-2 text-xs">
                                            <span class="text-gray-400">on</span>
                                            <a href="{{ route('blog.show', $comment->blog) }}" class="text-gray-600 hover:text-emerald-600 truncate max-w-[150px]">{{ $comment->blog->title }}</a>
                                            @if($comment->status === 'pending')
                                                <span class="px-2 py-0.5 rounded-full bg-yellow-100 text-yellow-700 text-[10px] font-medium uppercase">Pending</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8 text-gray-500 text-sm">
                                    No comments yet.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Trending Posts -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-900">Trending Posts</h3>
                            <a href="{{ route('dashboard.blog') }}?sort=popular" class="text-sm text-emerald-600 hover:text-emerald-700 font-medium">View Reports</a>
                        </div>
                        <div class="space-y-4">
                            @php($trending = \App\Models\Blog::with('author')->popular()->take(5)->get())
                            @foreach($trending as $post)
                                <div class="flex items-center gap-4 group">
                                    <div class="w-12 h-12 rounded-lg bg-gray-100 flex-shrink-0 overflow-hidden">
                                        @if($post->featured_image)
                                            <img src="{{ cdn_storage($post->featured_image) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-br from-emerald-500 to-teal-500"></div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-medium text-gray-900 truncate group-hover:text-emerald-600 transition-colors">
                                            <a href="{{ route('blog.show', $post) }}">{{ $post->title }}</a>
                                        </h4>
                                        <div class="flex items-center gap-3 mt-1 text-xs text-gray-500">
                                            <span>{{ number_format($post->views) }} views</span>
                                            <span>•</span>
                                            <span>{{ number_format($post->likes) }} likes</span>
                                        </div>
                                    </div>
                                    <div class="text-emerald-500 font-medium text-sm">
                                        +{{ rand(1, 15) }}%
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Quick actions -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('dashboard.blog') }}#create-post" class="group bg-white rounded-2xl border border-gray-200 shadow-sm p-6 hover:border-emerald-300 hover:shadow-lg transition-all">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-sm text-gray-500">Create</div>
                                <div class="text-xl font-semibold text-gray-900 mt-1">New Post</div>
                            </div>
                            <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('dashboard.users') }}" class="group bg-white rounded-2xl border border-gray-200 shadow-sm p-6 hover:border-blue-300 hover:shadow-lg transition-all">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-sm text-gray-500">Manage</div>
                                <div class="text-xl font-semibold text-gray-900 mt-1">Users</div>
                            </div>
                            <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('dashboard.categories') }}" class="group bg-white rounded-2xl border border-gray-200 shadow-sm p-6 hover:border-purple-300 hover:shadow-lg transition-all">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-sm text-gray-500">Manage</div>
                                <div class="text-xl font-semibold text-gray-900 mt-1">Categories</div>
                            </div>
                            <div class="w-12 h-12 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center group-hover:bg-purple-600 group-hover:text-white transition-colors">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="M3 5h8v8H3V5zm10 0h8v8h-8V5zM3 15h8v4H3v-4zm10 0h8v4h-8v-4z"/></svg>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Site quick links -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('dashboard.pages.index') }}" class="group bg-white rounded-2xl border border-gray-200 shadow-sm p-6 hover:border-gray-300 hover:shadow-md transition-all">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-sm text-gray-500">CMS</div>
                                <div class="text-lg font-semibold text-gray-900 tracking-tight mt-1">Pages</div>
                            </div>
                            <div class="rounded-lg bg-gray-100 text-gray-600 p-2 group-hover:bg-gray-600 group-hover:text-white transition-colors">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M6 2h9l5 5v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm8 7V3.5L19.5 9H14z"/></svg>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('dashboard.footer.edit') }}" class="group bg-white rounded-2xl border border-gray-200 shadow-sm p-6 hover:border-gray-300 hover:shadow-md transition-all">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-sm text-gray-500">Site</div>
                                <div class="text-lg font-semibold text-gray-900 tracking-tight mt-1">Footer</div>
                            </div>
                            <div class="rounded-lg bg-gray-100 text-gray-600 p-2 group-hover:bg-gray-600 group-hover:text-white transition-colors">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M3 4h18v2H3V4zm0 4h18v2H3V8zm0 8h18v2H3v-2zm0 4h12v2H3v-2z"/></svg>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('dashboard.domains.index') }}" class="group bg-white rounded-2xl border border-gray-200 shadow-sm p-6 hover:border-gray-300 hover:shadow-md transition-all">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-sm text-gray-500">Config</div>
                                <div class="text-lg font-semibold text-gray-900 tracking-tight mt-1">Domains</div>
                            </div>
                            <div class="rounded-lg bg-gray-100 text-gray-600 p-2 group-hover:bg-gray-600 group-hover:text-white transition-colors">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 100 20 10 10 0 000-20zm0 2c1.85 0 3.55.63 4.9 1.69L5.69 17.9A8 8 0 0112 4zm0 16a8 8 0 004.9-1.69L6.69 8.1A8 8 0 0012 20z"/></svg>
                            </div>
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
        @php($myLikesTotal = \App\Models\Blog::where('author_id', auth()->id())->sum('likes'))
        @php($recentPosts = \App\Models\Blog::where('author_id', auth()->id())->orderByDesc('created_at')->take(3)->get())

        <div class="py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
                <!-- Welcome Header -->
                <div class="rounded-2xl shadow-xl p-8 text-white relative overflow-hidden" style="background: linear-gradient(135deg, #10b981 0%, #3b82f6 100%);">
                    <div class="relative z-10">
                        <h3 class="text-3xl font-bold mb-2">Welcome back, {{ auth()->user()->name}}!</h3>
                        <p class="text-white/90 text-lg">Ready to write your next story?</p>
                        <div class="mt-6 flex items-center gap-3">
                            <a href="{{ route('dashboard.write') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-white text-emerald-600 hover:bg-gray-50 font-semibold transition-colors shadow-sm">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1.003 1.003 0 000-1.42l-2.34-2.34a1.003 1.003 0 00-1.42 0l-1.83 1.83 3.75 3.75 1.84-1.82z"/></svg>
                                Write a Story
                            </a>
                            <a href="{{ route('dashboard.my-posts') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-lg border-2 border-white/30 bg-white/10 text-white hover:bg-white/20 font-semibold transition-colors backdrop-blur-sm">
                                My Posts
                            </a>
                        </div>
                    </div>
                    <!-- Decorative background pattern -->
                    <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                    <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-64 h-64 bg-black/5 rounded-full blur-3xl"></div>
                </div>

                <!-- My Blog stats -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Your Stats</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 hover:shadow-md transition-shadow">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-sm text-gray-500">My Posts</div>
                                    <div class="mt-1 text-3xl font-bold text-gray-900">{{ number_format($myPostsTotal) }}</div>
                                </div>
                                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" viewBox="0 0 24 24" fill="currentColor"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z"/></svg>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 hover:shadow-md transition-shadow">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-sm text-gray-500">Drafts</div>
                                    <div class="mt-1 text-3xl font-bold text-amber-600">{{ number_format($myPostsDraft) }}</div>
                                </div>
                                <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-amber-600" viewBox="0 0 24 24" fill="currentColor"><path d="M14 10H2v2h12v-2zm0-4H2v2h12V6zm4 8v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zM2 16h8v-2H2v2z"/></svg>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 hover:shadow-md transition-shadow">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-sm text-gray-500">Published</div>
                                    <div class="mt-1 text-3xl font-bold text-emerald-600">{{ number_format($myPostsPublished) }}</div>
                                </div>
                                <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-emerald-600" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 hover:shadow-md transition-shadow">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-sm text-gray-500">Total Views</div>
                                    <div class="mt-1 text-3xl font-bold text-purple-600">{{ number_format($myViewsTotal) }}</div>
                                </div>
                                <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-purple-600" viewBox="0 0 24 24" fill="currentColor"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 hover:shadow-md transition-shadow">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-sm text-gray-500">Total Likes</div>
                                    <div class="mt-1 text-3xl font-bold text-pink-600">{{ number_format($myLikesTotal) }}</div>
                                </div>
                                <div class="w-12 h-12 rounded-full bg-pink-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-pink-600" viewBox="0 0 24 24" fill="currentColor"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Posts -->
                @if($recentPosts->count() > 0)
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Recent Posts</h3>
                            <a href="{{ route('dashboard.my-posts') }}" class="text-sm text-emerald-600 hover:text-emerald-700 font-medium">View all →</a>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach($recentPosts as $post)
                                <div class="bg-white rounded-xl border border-gray-200 hover:border-emerald-200 hover:shadow-lg transition-all overflow-hidden group">
                                    @if($post->featured_image)
                                        <img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-40 object-cover" />
                                    @else
                                        <div class="w-full h-40 bg-gradient-to-br from-emerald-50 to-blue-50 flex items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z"/></svg>
                                        </div>
                                    @endif
                                    <div class="p-5">
                                        <div class="flex items-center gap-2 mb-2">
                                            <span class="px-2 py-1 rounded-full text-xs font-medium {{ $post->status === 'published' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                                {{ ucfirst($post->status) }}
                                            </span>
                                            <span class="text-xs text-gray-500">{{ $post->formatted_date }}</span>
                                        </div>
                                        <h4 class="font-bold text-gray-900 line-clamp-2 group-hover:text-emerald-600 mb-2">
                                            <a href="{{ route('blog.show', $post->slug) }}" target="_blank">{{ $post->title }}</a>
                                        </h4>
                                        @if($post->excerpt)
                                            <p class="text-sm text-gray-600 line-clamp-2 mb-3">{{ $post->excerpt }}</p>
                                        @endif
                                        <div class="flex items-center gap-4 text-sm text-gray-500">
                                            <span>{{ number_format($post->views) }} views</span>
                                            <span>{{ number_format($post->likes) }} likes</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Quick actions grid -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('dashboard.stats') }}" class="group bg-white rounded-xl border border-gray-200 shadow-sm p-6 hover:border-emerald-300 hover:shadow-md transition-all">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-sm text-gray-500">View</div>
                                    <div class="text-lg font-semibold text-gray-900 tracking-tight mt-1">My Stats</div>
                                </div>
                                <div class="rounded-lg bg-emerald-100 text-emerald-600 p-2 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M3 13h8V3H3v10zm10 8h8v-6h-8v6zm0-18v6h8V3h-8zM3 21h8v-6H3v6z"/></svg>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('blog.index') }}" class="group bg-white rounded-xl border border-gray-200 shadow-sm p-6 hover:border-blue-300 hover:shadow-md transition-all">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-sm text-gray-500">Explore</div>
                                    <div class="text-lg font-semibold text-gray-900 tracking-tight mt-1">Stories</div>
                                </div>
                                <div class="rounded-lg bg-blue-100 text-blue-600 p-2 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2V4a2 2 0 00-2-2z"/></svg>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('dashboard.library') }}" class="group bg-white rounded-xl border border-gray-200 shadow-sm p-6 hover:border-purple-300 hover:shadow-md transition-all">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-sm text-gray-500">My</div>
                                    <div class="text-lg font-semibold text-gray-900 tracking-tight mt-1">Library</div>
                                </div>
                                <div class="rounded-lg bg-purple-100 text-purple-600 p-2 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-1 9H9V9h10v2zm-4 4H9v-2h6v2zm4-8H9V5h10v2z"/></svg>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-dashboard-layout>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('trafficChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    datasets: [{
                        label: 'Views',
                        data: [12, 19, 3, 5, 2, 3, 15],
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true
                    }, {
                        label: 'Likes',
                        data: [5, 8, 2, 3, 1, 2, 8],
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                borderDash: [2, 4],
                                color: '#f3f4f6'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endpush
