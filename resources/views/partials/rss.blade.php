<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
  <channel>
    <title>{{ config('app.name') }} Blog</title>
    <link>{{ route('blog.index') }}</link>
    <description>Latest articles from {{ config('app.name') }}</description>
    <language>en-us</language>
    <lastBuildDate>{{ $updated->toRfc2822String() }}</lastBuildDate>
    <atom:link href="{{ route('blog.feed') }}" rel="self" type="application/rss+xml" />

    @foreach($posts as $post)
      <item>
        <title><![CDATA[ {{ $post->title }} ]]></title>
        <link>{{ route('blog.show', $post->slug) }}</link>
        <guid isPermaLink="true">{{ route('blog.show', $post->slug) }}</guid>
        <pubDate>{{ ($post->published_at ?: $post->created_at)->toRfc2822String() }}</pubDate>
        @if($post->excerpt)
        <description><![CDATA[ {{ $post->excerpt }} ]]></description>
        @else
        <description><![CDATA[ {{ Str::limit(strip_tags($post->body ?? ''), 240) }} ]]></description>
        @endif
      </item>
    @endforeach
  </channel>
</rss>
