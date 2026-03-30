<x-admin-dashboard-layout title="Dashboard">
    <x-slot name="header">Dashboard</x-slot>

    @php
        $postsTotal = \App\Models\Blog::count();
        $postsDraft = \App\Models\Blog::where('status','draft')->count();
        $postsPublished = \App\Models\Blog::where('status','published')->count();
        $viewsTotal = \App\Models\Blog::sum('views');
        $usersTotal = \App\Models\User::count();
        $pagesTotal = \App\Models\SitePage::count();
        
        $recentPosts = \App\Models\Blog::with('author')->latest()->limit(5)->get();
    @endphp

    <style>
        .welcome-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 16px;
            padding: 32px;
            color: #fff;
            margin-bottom: 24px;
        }
        .welcome-title { font-size: 24px; font-weight: 600; margin-bottom: 8px; }
        .welcome-subtitle { font-size: 15px; opacity: 0.9; }
        
        .quick-links {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 12px;
            margin-bottom: 24px;
        }
        .quick-link {
            background: #fff;
            border-radius: 12px;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
            color: #1d1d1f;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 4px 12px rgba(0,0,0,0.04);
            transition: all 0.2s ease;
        }
        .quick-link:hover { transform: translateY(-2px); box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
        .quick-link-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .quick-link-icon svg { width: 20px; height: 20px; color: #fff; }
        .quick-link-text { font-size: 14px; font-weight: 500; }
        .quick-link-count { font-size: 12px; color: #86868b; }
        
        .section-title {
            font-size: 17px;
            font-weight: 600;
            color: #1d1d1f;
            margin-bottom: 16px;
        }
        
        .recent-list { background: #fff; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 4px 12px rgba(0,0,0,0.04); }
        .recent-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 20px;
            border-bottom: 1px solid rgba(0,0,0,0.04);
            text-decoration: none;
            color: inherit;
            transition: background 0.15s ease;
        }
        .recent-item:last-child { border-bottom: none; }
        .recent-item:hover { background: rgba(0,0,0,0.02); }
        .recent-thumb {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            background: #f5f5f7;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            overflow: hidden;
        }
        .recent-thumb img { width: 100%; height: 100%; object-fit: cover; }
        .recent-thumb svg { width: 20px; height: 20px; color: #86868b; }
        .recent-info { flex: 1; min-width: 0; }
        .recent-title { font-size: 14px; font-weight: 500; color: #1d1d1f; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .recent-meta { font-size: 12px; color: #86868b; margin-top: 2px; display: flex; align-items: center; gap: 8px; }
        .recent-badge {
            display: inline-flex;
            padding: 3px 8px;
            border-radius: 100px;
            font-size: 11px;
            font-weight: 500;
        }
        .recent-badge-green { background: #e8f5e9; color: #2e7d32; }
        .recent-badge-orange { background: #fff3e0; color: #ef6c00; }
        
        .empty-state {
            padding: 48px 24px;
            text-align: center;
        }
        .empty-state-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 16px;
            background: #f5f5f7;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .empty-state-icon svg { width: 24px; height: 24px; color: #86868b; }
        .empty-state-title { font-size: 15px; font-weight: 500; color: #1d1d1f; margin-bottom: 4px; }
        .empty-state-text { font-size: 13px; color: #86868b; }
    </style>

    <!-- Welcome -->
    <div class="welcome-card">
        <div class="welcome-title">Welcome back, {{ Auth::user()->name }}</div>
        <div class="welcome-subtitle">Here's what's happening with your website today.</div>
    </div>

    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-value">{{ number_format($postsTotal) }}</div>
            <div class="stat-label">Total Posts</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">{{ number_format($postsPublished) }}</div>
            <div class="stat-label">Published</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">{{ number_format($postsDraft) }}</div>
            <div class="stat-label">Drafts</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">{{ number_format($viewsTotal) }}</div>
            <div class="stat-label">Total Views</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">{{ number_format($usersTotal) }}</div>
            <div class="stat-label">Users</div>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="quick-links">
        <a href="{{ route('dashboard.blog') }}" class="quick-link">
            <div class="quick-link-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <div>
                <div class="quick-link-text">Blog Posts</div>
                <div class="quick-link-count">{{ $postsTotal }} posts</div>
            </div>
        </a>
        
        <a href="{{ route('dashboard.pages.index') }}" class="quick-link">
            <div class="quick-link-icon" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
            </div>
            <div>
                <div class="quick-link-text">Pages</div>
                <div class="quick-link-count">{{ $pagesTotal }} pages</div>
            </div>
        </a>
        
        <a href="{{ route('dashboard.users') }}" class="quick-link">
            <div class="quick-link-icon" style="background: linear-gradient(135deg, #ee0979 0%, #ff6a00 100%);">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <div>
                <div class="quick-link-text">Users</div>
                <div class="quick-link-count">{{ $usersTotal }} users</div>
            </div>
        </a>
        
        <a href="{{ route('dashboard.team') }}" class="quick-link">
            <div class="quick-link-icon" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <div>
                <div class="quick-link-text">Team</div>
                <div class="quick-link-count">Manage team</div>
            </div>
        </a>
    </div>

    <!-- Recent Posts -->
    <div class="section-title">Recent Posts</div>
    <div class="recent-list">
        @forelse($recentPosts as $post)
            <a href="{{ route('dashboard.blog.edit', $post) }}" class="recent-item">
                <div class="recent-thumb">
                    @if($post->featured_image)
                        <img src="{{ cdn_storage($post->featured_image) }}" alt="">
                    @else
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    @endif
                </div>
                <div class="recent-info">
                    <div class="recent-title">{{ $post->title }}</div>
                    <div class="recent-meta">
                        <span class="recent-badge {{ $post->status === 'published' ? 'recent-badge-green' : 'recent-badge-orange' }}">
                            {{ ucfirst($post->status) }}
                        </span>
                        <span>{{ $post->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </a>
        @empty
            <div class="empty-state">
                <div class="empty-state-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div class="empty-state-title">No posts yet</div>
                <div class="empty-state-text">Create your first blog post to get started.</div>
            </div>
        @endforelse
    </div>
</x-admin-dashboard-layout>
