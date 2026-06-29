@extends('layouts.blog')

@section('seo_title', $seoData['title'])
@section('seo_description', $seoData['description'])
@section('seo_image', $seoData['image'])
@section('seo_keywords', $seoData['keywords'])
@section('seo_author', $author->name)

@push('schema')
{{-- Person Schema for Author --}}
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Person",
  "name": @json($author->name),
  "url": @json($author->author_url),
  "image": @json($author->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($author->name) . '&background=00ff88&color=000000'),
  "jobTitle": "Founder & CEO",
  "worksFor": {
    "@type": "Organization",
    "name": "Sanaa Co.",
    "url": "https://sanaa.ug"
  },
  "sameAs": [
    "https://sanaa.ug",
    "https://twitter.com/sanaaco"
  ],
  "description": @json('Founder of Sanaa Co. Writing about building the digital backbone for Africa\'s next economy.'),
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": @json($author->author_url)
  }
}
</script>

{{-- Collection Page Schema --}}
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "CollectionPage",
  "name": @json($seoData['title']),
  "description": @json($seoData['description']),
  "url": @json($seoData['url']),
  "author": {
    "@type": "Person",
    "name": @json($author->name),
    "url": @json($author->author_url)
  },
  "mainEntity": {
    "@type": "ItemList",
    "numberOfItems": {{ $posts->count() }},
    "itemListElement": [
      @foreach($posts as $index => $post)
      {
        "@type": "ListItem",
        "position": {{ $index + 1 }},
        "url": @json($post->url),
        "name": @json($post->title)
      }@if(!$loop->last),@endif
      @endforeach
    ]
  }
}
</script>

{{-- BreadcrumbList Schema --}}
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Sanaa Blog",
      "item": @json(route('blog.index'))
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": @json($author->name),
      "item": @json($author->author_url)
    }
  ]
}
</script>
@endpush

@push('styles')
<style>
  .author-page {
    max-width: 76rem;
    margin: 0 auto;
    padding: 3.5rem 1.5rem 5rem;
  }

  .author-hero {
    display: grid;
    gap: 1.5rem;
    padding: 2rem 0 2.5rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  }

  .author-kicker {
    margin: 0;
    color: rgba(52, 211, 153, 0.92);
    font-size: 0.76rem;
    letter-spacing: 0.28em;
    text-transform: uppercase;
  }

  .author-heading {
    margin: 0;
    font-size: clamp(2.5rem, 5vw, 4.5rem);
    line-height: 0.94;
    letter-spacing: -0.06em;
    color: #fff;
    font-weight: 300;
  }

  .author-summary {
    max-width: 44rem;
    margin: 0;
    color: rgba(255, 255, 255, 0.68);
    font-size: 1.04rem;
    line-height: 1.75;
  }

  .author-meta {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.8rem 1.2rem;
    color: rgba(255, 255, 255, 0.54);
    font-size: 0.92rem;
  }

  .author-avatar-lg {
    width: 4.5rem;
    height: 4.5rem;
    border-radius: 999px;
    object-fit: cover;
    border: 1px solid rgba(255, 255, 255, 0.12);
  }

  .author-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(18rem, 1fr));
    gap: 1.25rem;
    margin-top: 2.25rem;
  }

  .author-card {
    display: flex;
    flex-direction: column;
    min-height: 100%;
    border-radius: 1.5rem;
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.1);
    background: rgba(255, 255, 255, 0.02);
    text-decoration: none;
    transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
  }

  .author-card:hover {
    transform: translateY(-4px);
    border-color: rgba(52, 211, 153, 0.36);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.28);
  }

  .author-card-media {
    aspect-ratio: 16 / 10;
    background-size: cover;
    background-position: center;
    background-color: #0a0d10;
  }

  .author-card-copy {
    display: flex;
    flex: 1;
    flex-direction: column;
    gap: 0.9rem;
    padding: 1.25rem;
  }

  .author-card-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    color: rgba(255, 255, 255, 0.48);
    font-size: 0.74rem;
    letter-spacing: 0.12em;
    text-transform: uppercase;
  }

  .author-card-title {
    margin: 0;
    color: #fff;
    font-size: 1.35rem;
    line-height: 1.1;
    letter-spacing: -0.04em;
    font-weight: 400;
  }

  .author-card-excerpt {
    margin: 0;
    color: rgba(255, 255, 255, 0.68);
    font-size: 0.98rem;
    line-height: 1.65;
  }

  .author-card-footer {
    margin-top: auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.9rem;
  }

  .author-card-link {
    color: #34d399;
    font-weight: 500;
  }

  .author-pagination {
    margin-top: 2rem;
  }
</style>
@endpush

@section('content')
<div class="author-page">
    <section class="author-hero">
        <p class="author-kicker">Author Archive</p>
        <div class="author-meta">
            <img
                class="author-avatar-lg"
                src="{{ $author->avatar ? asset('storage/' . $author->avatar) : ('https://ui-avatars.com/api/?name=' . urlencode($author->name) . '&background=00ff88&color=000000') }}"
                alt="{{ $author->name }}">
            <span>{{ $posts->total() }} article{{ $posts->total() === 1 ? '' : 's' }}</span>
            <span>{{ $author->name }}</span>
        </div>
        <h1 class="author-heading">{{ $author->name }}</h1>
        <p class="author-summary">
            Founder notes, operating lessons, and articles published on Sanaa.ug by {{ $author->name }}.
        </p>
    </section>

    <section class="author-grid">
        @foreach($posts as $post)
            <a href="{{ $post->url }}" class="author-card">
                <div
                    class="author-card-media"
                    style="background-image:url('{{ $post->featured_image_url }}')"></div>
                <div class="author-card-copy">
                    <div class="author-card-meta">
                        <span>{{ $post->category->name ?? 'Journal' }}</span>
                        <span>{{ $post->formatted_date }}</span>
                    </div>
                    <h2 class="author-card-title">{{ $post->title }}</h2>
                    <p class="author-card-excerpt">{{ \Illuminate\Support\Str::limit($post->excerpt, 130) }}</p>
                    <div class="author-card-footer">
                        <span>{{ $post->reading_time ?? 5 }} min read</span>
                        <span class="author-card-link">Read article</span>
                    </div>
                </div>
            </a>
        @endforeach
    </section>

    <div class="author-pagination">
        {{ $posts->links() }}
    </div>
</div>
@endsection
