{{-- Blog Section Partial --}}
@php
    try {
        $featuredBlog = \App\Models\Blog::published()
            ->with(['author', 'category'])
            ->where('slug', 'i-dont-know-if-i-can-do-this-anymore')
            ->first();

        $otherBlogs = \App\Models\Blog::published()
            ->with(['author', 'category'])
            ->when($featuredBlog, fn ($query) => $query->where('id', '!=', $featuredBlog->id))
            ->orderByRaw('COALESCE(published_at, created_at) DESC')
            ->take(5)
            ->get();
    } catch (\Throwable $e) {
        $featuredBlog = null;
        $otherBlogs = collect();
    }
    $featuredImage = $featuredBlog && $featuredBlog->featured_image
        ? ($featuredBlog->featured_image_url ?? asset('storage/' . $featuredBlog->featured_image))
        : null;
@endphp

<style>
    .sn-blog__header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1.25rem;
        margin-bottom: 2.5rem;
    }

    .sn-blog__header-left {
        flex: 1;
        min-width: 220px;
    }

    .sn-blog__subtext {
        font-size: 0.97rem;
        line-height: 1.7;
        color: var(--stone-500);
        margin-top: 0.5rem;
        max-width: 44ch;
    }

    .sn-blog__see-all {
        font-size: 0.85rem;
        font-weight: 500;
        color: var(--stone-500);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        transition: color 0.15s ease;
        flex-shrink: 0;
    }

    .sn-blog__see-all:hover {
        color: var(--ink);
    }

    /* 2fr 1fr 1fr grid — featured spans 2 rows */
    .sn-blog__grid {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
        grid-template-rows: auto auto;
        gap: 1.25rem;
    }

    /* ── Featured card ── */
    .sn-blog-featured {
        grid-column: 1;
        grid-row: 1 / 3;
        position: relative;
        background: var(--ink);
        border-radius: 18px;
        overflow: hidden;
        min-height: 420px;
        display: flex;
        flex-direction: column;
        text-decoration: none;
        transition: box-shadow 0.15s ease;
    }

    .sn-blog-featured:hover {
        box-shadow: 0 8px 32px rgba(10,10,9,0.18);
    }

    .sn-blog-featured__bg {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        opacity: 0.22;
    }

    .sn-blog-featured__gradient {
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse 80% 60% at 30% 80%, rgba(16,185,129,0.22), transparent 70%),
            linear-gradient(180deg, rgba(10,10,9,0.3) 0%, rgba(10,10,9,0.85) 100%);
    }

    .sn-blog-featured__body {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        flex: 1;
        padding: 2rem;
        justify-content: flex-end;
    }

    .sn-blog-featured__category {
        font-size: 0.65rem;
        font-weight: 600;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--emerald-400);
        margin-bottom: 0.85rem;
    }

    .sn-blog-featured__title {
        font-family: var(--font-serif);
        font-size: clamp(1.35rem, 2.5vw, 1.85rem);
        font-weight: 400;
        line-height: 1.25;
        color: #ffffff;
        margin-bottom: 1.1rem;
    }

    .sn-blog-featured__meta {
        display: flex;
        flex-wrap: wrap;
        gap: 0.4rem 1rem;
        font-size: 0.78rem;
        color: rgba(255,255,255,0.46);
    }

    /* ── Secondary cards ── */
    .sn-blog-card {
        background: #ffffff;
        border: 1px solid var(--stone-200);
        border-radius: 18px;
        box-shadow: var(--shadow-1);
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        text-decoration: none;
        color: var(--ink);
        transition: box-shadow 0.15s ease;
    }

    .sn-blog-card:hover {
        box-shadow: var(--shadow-2);
    }

    .sn-blog-card__category {
        font-size: 0.65rem;
        font-weight: 600;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: var(--stone-400);
        margin-bottom: 0.65rem;
    }

    .sn-blog-card__title {
        font-size: 0.97rem;
        font-weight: 500;
        line-height: 1.45;
        color: var(--ink);
        flex: 1;
        margin-bottom: 1rem;
    }

    .sn-blog-card__meta {
        display: flex;
        flex-wrap: wrap;
        gap: 0.3rem 0.75rem;
        font-size: 0.75rem;
        color: var(--stone-400);
    }

    /* ── No-posts fallback ── */
    .sn-blog__empty {
        grid-column: 1 / -1;
        text-align: center;
        padding: 4rem 2rem;
        color: var(--stone-400);
        font-size: 0.95rem;
    }

    @media (max-width: 960px) {
        .sn-blog__grid {
            grid-template-columns: 1fr 1fr;
        }

        .sn-blog-featured {
            grid-column: 1 / -1;
            grid-row: auto;
            min-height: 320px;
        }
    }

    @media (max-width: 580px) {
        .sn-blog__grid {
            grid-template-columns: 1fr;
        }

        .sn-blog-featured {
            grid-column: auto;
        }
    }
</style>

<div class="sn-container">
    <div class="sn-blog__header">
        <div class="sn-blog__header-left">
            <p class="sn-eyebrow">Founder Journal</p>
            <h2 class="sn-h2" id="blog-heading">Latest insights.</h2>
            <p class="sn-blog__subtext">Writing from inside the build. Founder notes, operating lessons, and the thinking behind the stack.</p>
        </div>
        <a href="{{ route('blog.index') }}" class="sn-blog__see-all">See all articles &rarr;</a>
    </div>

    <div class="sn-blog__grid">
        @if($featuredBlog)
            @php
                $featuredUrl = $featuredBlog->url ?? route('blog.show', $featuredBlog->slug ?? $featuredBlog->id);
            @endphp
            <a href="{{ $featuredUrl }}" class="sn-blog-featured">
                @if($featuredImage)
                    <div class="sn-blog-featured__bg" style="background-image: url('{{ $featuredImage }}');" aria-hidden="true"></div>
                @endif
                <div class="sn-blog-featured__gradient" aria-hidden="true"></div>
                <div class="sn-blog-featured__body">
                    <div class="sn-blog-featured__category">
                        @if($featuredBlog->category){{ $featuredBlog->category->name }}@else Featured @endif
                    </div>
                    <h3 class="sn-blog-featured__title">{{ $featuredBlog->title }}</h3>
                    <div class="sn-blog-featured__meta">
                        <span>{{ $featuredBlog->author->name ?? 'Sanaa Team' }}</span>
                        <span>{{ $featuredBlog->formatted_date ?? optional($featuredBlog->created_at)->format('M d, Y') }}</span>
                        <span>{{ $featuredBlog->reading_time ?? 6 }} min read</span>
                    </div>
                </div>
            </a>
        @endif

        @forelse($otherBlogs->take(5) as $blog)
            @php
                $blogUrl = $blog->url ?? route('blog.show', $blog->slug ?? $blog->id);
            @endphp
            <a href="{{ $blogUrl }}" class="sn-blog-card">
                <div class="sn-blog-card__category">
                    {{ $blog->category->name ?? 'Journal' }}
                </div>
                <h4 class="sn-blog-card__title">{{ \Illuminate\Support\Str::limit($blog->title, 80) }}</h4>
                <div class="sn-blog-card__meta">
                    <span>{{ $blog->author->name ?? 'Sanaa Team' }}</span>
                    <span>{{ $blog->formatted_date ?? optional($blog->created_at)->format('M d, Y') }}</span>
                    <span>{{ $blog->reading_time ?? 5 }} min</span>
                </div>
            </a>
        @empty
            @if(!$featuredBlog)
                <div class="sn-blog__empty">No articles yet. Check back soon.</div>
            @endif
        @endforelse
    </div>
</div>
